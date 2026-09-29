<?php

namespace App\Http\Controllers;

use App\Models\DigitalBook;
use Illuminate\Http\Request;

class DigitalBookController extends Controller
{
    public function index(Request $request)
    {
        $query = DigitalBook::published()->latest();

        // 1. Search Query
        if ($request->filled('q')) {
            $search = trim($request->q);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // 2. Category Filter
        $activeCategory = $request->get('kategori', 'all');
        if ($activeCategory === 'Buku Baru') {
            $query->where('year', '>=', date('Y'));
        } elseif ($activeCategory === 'Best Seller' || $activeCategory === 'Unggulan') {
            $query->where('is_featured', true);
        } elseif ($activeCategory !== 'all' && !empty($activeCategory)) {
            $query->where('category', $activeCategory);
        }

        // 3. PDF Only Filter
        if ($request->boolean('pdf_only')) {
            $query->whereNotNull('pdf_file');
        }

        $digitalBooks = $query->paginate(12)->withQueryString();

        // Categories Stats
        $categoryStats = DigitalBook::published()
            ->select('category')
            ->selectRaw('count(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        $totalDigitalBooks = DigitalBook::published()->count();
        $totalWithPdf = DigitalBook::published()->whereNotNull('pdf_file')->count();
        $totalFeatured = DigitalBook::published()->where('is_featured', true)->count();
        $totalNew = DigitalBook::published()->where('year', '>=', date('Y'))->count();

        // Featured / Popular Digital Books
        $popularBooks = DigitalBook::published()
            ->where(function($q) {
                $q->where('is_featured', true)
                  ->orWhereNotNull('pdf_file');
            })
            ->take(6)
            ->get();

        // Active Book to read on open (via ?baca=slug or null)
        $activeBook = null;
        if ($request->filled('baca')) {
            $slug = $request->baca;
            $activeBook = DigitalBook::published()->where('slug', $slug)->orWhere('id', $slug)->first();
        }

        // Donation Settings from SiteSetting
        $donationSettings = [
            'active'       => \App\Models\SiteSetting::get('donation_active', '1') === '1',
            'title'        => \App\Models\SiteSetting::get('donation_title', 'Dukung Penerbitan Buku Islam'),
            'desc'         => \App\Models\SiteSetting::get('donation_desc', 'Buku ini dapat diakses dan diunduh secara digital. Jika buku ini bermanfaat bagi Anda, mari ikut mendukung Persis Pers agar dapat terus menerbitkan dan menyebarluaskan karya-karya keislaman.'),
            'qris_image'   => \App\Models\SiteSetting::get('donation_qris_image', ''),
            'bank_name'    => \App\Models\SiteSetting::get('donation_bank_name', 'Bank Syariah Indonesia (BSI)'),
            'bank_account' => \App\Models\SiteSetting::get('donation_bank_account', '7148888999'),
            'bank_holder'  => \App\Models\SiteSetting::get('donation_bank_holder', 'PENERBIT PERSIS DONASI'),
            'wa_contact'   => \App\Models\SiteSetting::get('donation_wa_contact', '6285978006263'),
        ];

        return view('katalog-digital', compact(
            'digitalBooks',
            'categoryStats',
            'activeCategory',
            'totalDigitalBooks',
            'totalWithPdf',
            'totalFeatured',
            'totalNew',
            'popularBooks',
            'activeBook',
            'donationSettings'
        ));
    }

    public function show($slug, Request $request)
    {
        $activeBook = DigitalBook::published()->where('slug', $slug)->first();
        if (!$activeBook) {
            $activeBook = DigitalBook::published()->where('id', $slug)->first();
        }
        if (!$activeBook) {
            $titleFromSlug = str_replace('-', ' ', $slug);
            $activeBook = DigitalBook::published()->where('title', 'like', "%{$titleFromSlug}%")->first();
        }
        if (!$activeBook) {
            return redirect()->route('katalog.digital');
        }

        return redirect()->route('katalog.digital', ['baca' => $activeBook->slug]);
    }

    /**
     * Live Instant Autocomplete Search API for Digital Books
     */
    public function searchApi(Request $request)
    {
        try {
            $q = trim((string) $request->input('q', ''));

            if (empty($q) || mb_strlen($q) < 1) {
                return response()->json([
                    'success' => true,
                    'count'   => 0,
                    'books'   => [],
                ]);
            }

            $searchTerms = array_filter(explode(' ', $q));

            $query = DigitalBook::published();
            $query->where(function ($sub) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $term = str_replace(['%', '_'], ['\%', '\_'], $term);
                    $sub->where(function ($w) use ($term) {
                        $w->where('title', 'like', "%{$term}%")
                          ->orWhere('author', 'like', "%{$term}%")
                          ->orWhere('category', 'like', "%{$term}%");
                    });
                }
            });

            $books = $query->take(8)->get()->map(function ($book) {
                $coverUrl = $book->cover_url;
                $pdfUrl = $book->pdf_url;

                return [
                    'id'              => $book->id,
                    'title'           => $book->title,
                    'slug'            => $book->slug,
                    'author'          => $book->author ?: 'Penulis PERSIS',
                    'category'        => $book->category ?: 'Studi Islam',
                    'year'            => $book->year ?: '2026',
                    'pages'           => $book->pages ?: '-',
                    'cover_url'       => $coverUrl,
                    'pdf_url'         => $pdfUrl,
                    'has_pdf'         => !empty($book->pdf_file),
                    'is_featured'     => (bool)$book->is_featured,
                    'reader_url'      => route('katalog.digital', ['baca' => $book->slug]),
                ];
            });

            return response()->json([
                'success' => true,
                'count'   => $books->count(),
                'books'   => $books,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'count'   => 0,
                'books'   => [],
                'message' => $e->getMessage(),
            ], 200);
        }
    }
}
