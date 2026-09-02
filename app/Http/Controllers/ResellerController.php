<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ResellerController extends Controller
{
    /**
     * Display the Reseller & Agen information and registration page.
     */
    public function index()
    {
        $settings = [
            'contact_whatsapp' => SiteSetting::get('contact_whatsapp', '082116116133'),
            'contact_phone' => SiteSetting::get('contact_phone', '(022) 5441951'),
            'contact_email' => SiteSetting::get('contact_email', 'info@penerbitpersis.com'),
            'contact_address' => SiteSetting::get('contact_address', 'Kantor Redaksi PERSIS PERS, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287'),
        ];

        return view('reseller', compact('settings'));
    }
}
