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

        // Fetch categories dynamically
        $rawCategories = Book::published()->select('category')->distinct()->pluck('category');
        $categories = [
            ['name' => 'Semua Buku', 'slug' => 'all', 'count' => Book::published()->count()],
            ['name' => 'Buku Baru', 'slug' => 'new', 'count' => Book::published()->where('is_new_release', true)->count()],
            ['name' => 'Best Seller', 'slug' => 'bestseller', 'count' => Book::published()->where('is_best_seller', true)->count()],
        ];

        foreach ($rawCategories as $catName) {
            $categories[] = [
                'name' => $catName,
                'slug' => Str::slug($catName),
                'count' => Book::published()->where('category', $catName)->count(),
            ];
        }

        // Fetch new books & best sellers
        $newBooks = Book::published()->where('is_new_release', true)->latest()->take(4)->get();
        if ($newBooks->isEmpty()) {
            $newBooks = Book::published()->latest()->take(4)->get();
        }

        $bestSellers = Book::published()->where('is_best_seller', true)->latest()->take(4)->get();
        if ($bestSellers->isEmpty()) {
            $bestSellers = Book::published()->latest()->take(4)->get();
        }

        $totalBooksCount = Book::published()->count();

        return view('katalog', compact('categories', 'newBooks', 'bestSellers', 'settings', 'totalBooksCount'));
    }
}
