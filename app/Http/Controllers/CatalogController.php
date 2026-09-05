<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $settings = [
            'catalog_banner_badge' => SiteSetting::get('catalog_banner_badge', 'PUBLIKASI RESMI BER-ISBN'),
            'catalog_banner_title' => SiteSetting::get('catalog_banner_title', 'Katalog Buku & Karya Ilmiah'),
            'catalog_banner_desc' => SiteSetting::get('catalog_banner_desc', 'Koleksi buku ajar perguruan tinggi, monograf riset dosen, dan literatur keislaman ber-ISBN resmi terbitan PERSIS PERS.'),
            'catalog_promo_title' => SiteSetting::get('catalog_promo_title', 'Diskon Biaya Cetak 15% untuk Konversi Skripsi & Tesis'),
            'catalog_promo_desc' => SiteSetting::get('catalog_promo_desc', 'Paket lengkap pengurusan ISBN, layout standar UNESCO, dan proofreading.'),
            'catalog_agenda_title' => SiteSetting::get('catalog_agenda_title', 'Bedah Buku & Call for Book Chapters Dosen'),
            'catalog_agenda_desc' => SiteSetting::get('catalog_agenda_desc', 'Terbuka untuk civitas akademika dan peneliti eksternal.'),
            'catalog_publish_box_title' => SiteSetting::get('catalog_publish_box_title', 'Punya Naskah Buku Sendiri?'),
            'catalog_publish_box_desc' => SiteSetting::get('catalog_publish_box_desc', 'Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak prima.'),
        ];

        // Query for All Books (Main Grid with Pagination & Filter)
        $query = Book::published()->latest();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        $activeCategory = $request->get('kategori', 'all');

        if ($request->filled('kategori') && !in_array($request->kategori, ['all', 'Semua', 'Semua Kategori', 'Semua Buku'])) {
            $kategori = $request->kategori;
            if ($kategori === 'new' || $kategori === 'Buku Baru') {
                $query->where('is_new_release', true);
            } elseif ($kategori === 'bestseller' || $kategori === 'Best Seller') {
                $query->where('is_best_seller', true);
            } else {
                $query->where('category', $kategori);
            }
        }

        $books = $query->paginate(12)->withQueryString();

        // Distinct categories with book count
        $rawCategories = Book::published()->select('category')->distinct()->pluck('category');
        $categoriesWithCount = [];
        foreach ($rawCategories as $cat) {
            $categoriesWithCount[] = [
                'name' => $cat,
                'count' => Book::published()->where('category', $cat)->count()
            ];
        }

        // Top Shelf Showcase Books (8 latest books)
        $shelfBooks = Book::published()->latest()->take(8)->get();

        // 4 New Releases
        $newBooks = Book::published()->where('is_new_release', true)->latest()->take(4)->get();
        if ($newBooks->isEmpty()) {
            $newBooks = Book::published()->latest()->take(4)->get();
        }

        // 4 Best Sellers
        $bestSellers = Book::published()->where('is_best_seller', true)->latest()->take(4)->get();
        if ($bestSellers->isEmpty()) {
            $bestSellers = Book::published()->latest()->skip(4)->take(4)->get();
        }

        $totalBooksCount = Book::published()->count();
        $allSearchableBooks = Book::published()->select(
            'id', 'title', 'slug', 'author', 'category', 'isbn', 'price', 'year', 'format', 
            'pages', 'synopsis', 'is_new_release', 'is_best_seller', 'cover_image', 
            'back_cover_image', 'inside_preview_image', 'additional_image', 'sample_pdf'
        )->get();

        return view('katalog', compact(
            'books', 
            'categoriesWithCount', 
            'shelfBooks', 
            'newBooks', 
            'bestSellers', 
            'settings', 
            'totalBooksCount',
            'allSearchableBooks',
            'activeCategory'
        ));
    }

    public function searchApi(Request $request)
    {
        try {
            $q = trim($request->input('q', ''));

            $query = Book::query();

            // Handle status published or default/null
            $query->where(function ($qb) {
                $qb->where('status', 'published')
                   ->orWhereNull('status')
                   ->orWhere('status', '');
            });

            if (!empty($q)) {
                $query->where(function ($queryBuilder) use ($q) {
                    $queryBuilder->where('title', 'like', "%{$q}%")
                                 ->orWhere('author', 'like', "%{$q}%")
                                 ->orWhere('isbn', 'like', "%{$q}%")
                                 ->orWhere('category', 'like', "%{$q}%")
                                 ->orWhere('synopsis', 'like', "%{$q}%");
                });
            }

            $books = $query->latest('id')->take(10)->get()->map(function ($book) {
                // Safe Price Formatting for PHP 8.3
                $rawPrice = (string)$book->price;
                $formattedPrice = $rawPrice ?: 'Hubungi Admin';
                if (is_numeric($rawPrice)) {
                    $formattedPrice = 'Rp ' . number_format((float)$rawPrice, 0, ',', '.');
                } elseif (preg_match('/[0-9]+/', $rawPrice)) {
                    $numOnly = preg_replace('/[^0-9]/', '', $rawPrice);
                    if (!empty($numOnly)) {
                        $formattedPrice = 'Rp ' . number_format((float)$numOnly, 0, ',', '.');
                    }
                }

                // Cover Image URL Resolver
                $coverUrl = null;
                if (!empty($book->cover_image)) {
                    $coverUrl = (str_starts_with($book->cover_image, 'http') || str_starts_with($book->cover_image, '/'))
                        ? $book->cover_image
                        : asset('storage/' . $book->cover_image);
                }

                return [
                    'id'              => $book->id,
                    'title'           => $book->title,
                    'slug'            => $book->slug,
                    'author'          => $book->author ?: 'Penulis PERSIS',
                    'category'        => $book->category ?: 'Buku Ajar',
                    'isbn'            => $book->isbn ?: '',
                    'price'           => $rawPrice,
                    'formatted_price' => $formattedPrice,
                    'year'            => $book->year ?: '2026',
                    'pages'           => $book->pages ?: '-',
                    'cover_url'       => $coverUrl,
                    'is_new_release'  => (bool)$book->is_new_release,
                    'is_best_seller'  => (bool)$book->is_best_seller,
                    'catalog_url'     => route('katalog', ['q' => $book->title]),
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
            ], 200); // return 200 so fetch JSON doesn't trigger fatal network error
        }
    }
}
