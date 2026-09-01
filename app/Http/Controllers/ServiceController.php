<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->first();

        // If not found in DB, check if it matches default seeds or fallback
        if (!$service) {
            $service = Service::where('slug', 'like', "%{$slug}%")->first();
        }

        if (!$service) {
            abort(404, 'Layanan tidak ditemukan.');
        }

        // Fetch other active services for sidebar / bottom grid
        $otherServices = Service::where('id', '!=', $service->id)
            ->where('status', 'published')
            ->orderBy('order')
            ->take(4)
            ->get();

        $whatsapp = SiteSetting::get('contact_whatsapp', '6281234567890');
        $cleanWa = preg_replace('/[^0-9]/', '', $whatsapp);

        return view('services.show', compact('service', 'otherServices', 'cleanWa'));
    }
}
