<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $settings = [
            'catalog_banner_badge' => SiteSetting::get('catalog_banner_badge', 'PUBLIKASI RESMI KAMPUS'),
            'catalog_banner_title' => SiteSetting::get('catalog_banner_title', 'Katalog Buku & Karya Ilmiah'),
            'catalog_banner_desc' => SiteSetting::get('catalog_banner_desc', 'Koleksi buku ajar perguruan tinggi, monograf riset dosen, dan literatur keislaman ber-ISBN resmi terbitan PERSIS PERS.'),
            'catalog_stat_books' => SiteSetting::get('catalog_stat_books', '150+ Judul Buku'),
            'catalog_stat_authors' => SiteSetting::get('catalog_stat_authors', 'Karya Dosen & Peneliti'),
            'catalog_stat_isbn' => SiteSetting::get('catalog_stat_isbn', 'ISBN Perpusnas'),
            'catalog_stat_print' => SiteSetting::get('catalog_stat_print', 'Cetak Berkualitas'),
            'catalog_promo_title' => SiteSetting::get('catalog_promo_title', 'Diskon Biaya Cetak 15% untuk Konversi Skripsi & Tesis'),
            'catalog_promo_desc' => SiteSetting::get('catalog_promo_desc', 'Paket lengkap pengurusan ISBN, layout standar UNESCO, dan proofreading.'),
            'catalog_agenda_title' => SiteSetting::get('catalog_agenda_title', 'Bedah Buku & Call for Book Chapters Dosen'),
            'catalog_agenda_desc' => SiteSetting::get('catalog_agenda_desc', 'Terbuka untuk civitas akademika dan peneliti eksternal.'),
            'catalog_publish_box_title' => SiteSetting::get('catalog_publish_box_title', 'Punya Naskah Buku Sendiri?'),
            'catalog_publish_box_desc' => SiteSetting::get('catalog_publish_box_desc', 'Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak prima.'),
        ];

        // All Books Query with Filter & Search
        $query = Book::published()->latest();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori') && !in_array($request->kategori, ['Semua', 'all', 'Semua Kategori', 'Semua Buku'])) {
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

        // Distinct category list
        $categoryList = Book::published()->select('category')->distinct()->pluck('category')->toArray();

        // 4 New Releases Highlight
        $newBooks = Book::published()->where('is_new_release', true)->latest()->take(4)->get();
        if ($newBooks->isEmpty()) {
            $newBooks = Book::published()->latest()->take(4)->get();
        }

        // 4 Best Sellers Highlight
        $bestSellers = Book::published()->where('is_best_seller', true)->latest()->take(4)->get();
        if ($bestSellers->isEmpty()) {
            $bestSellers = Book::published()->latest()->take(4)->get();
        }

        $totalBooksCount = Book::published()->count();

        return view('katalog', compact('books', 'categoryList', 'newBooks', 'bestSellers', 'settings', 'totalBooksCount'));
    }
}
