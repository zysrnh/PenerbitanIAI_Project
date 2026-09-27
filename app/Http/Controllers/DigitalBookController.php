<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class DigitalBookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::published()->latest();

        // 1. Search Query
        if ($request->filled('q')) {
            $search = trim($request->q);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        // 2. Category Filter
        $activeCategory = $request->get('kategori', 'all');
        if ($activeCategory !== 'all' && !empty($activeCategory)) {
            $query->where('category', $activeCategory);
        }

        // 3. Optional filter: only with PDF
        if ($request->boolean('pdf_only')) {
            $query->whereNotNull('sample_pdf');
        }

        $books = $query->paginate(12)->withQueryString();

        // Distinct Categories with Book Count
        $categoryStats = Book::published()
            ->select('category')
            ->selectRaw('count(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        $totalDigitalBooks = Book::published()->count();
        $totalWithPdf = Book::published()->whereNotNull('sample_pdf')->count();

        // Popular / Featured Kitab / Digital Books
        $popularBooks = Book::published()
            ->where(function($q) {
                $q->where('is_best_seller', true)
                  ->orWhere('is_new_release', true)
                  ->orWhereNotNull('sample_pdf');
            })
            ->take(6)
            ->get();

        // Active Book to read on open (via ?baca=slug or null)
        $activeBook = null;
        if ($request->filled('baca')) {
            $slug = $request->baca;
            $activeBook = Book::published()->where('slug', $slug)->orWhere('id', $slug)->first();
        }

        return view('katalog-digital', compact(
            'books',
            'categoryStats',
            'activeCategory',
            'totalDigitalBooks',
            'totalWithPdf',
            'popularBooks',
            'activeBook'
        ));
    }

    public function show($slug, Request $request)
    {
        $activeBook = Book::published()->where('slug', $slug)->first();
        if (!$activeBook) {
            $activeBook = Book::published()->where('id', $slug)->first();
        }
        if (!$activeBook) {
            $titleFromSlug = str_replace('-', ' ', $slug);
            $activeBook = Book::published()->where('title', 'like', "%{$titleFromSlug}%")->first();
        }
        if (!$activeBook) {
            return redirect()->route('katalog.digital');
        }

        return redirect()->route('katalog.digital', ['baca' => $activeBook->slug]);
    }
}
