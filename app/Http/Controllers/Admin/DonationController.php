<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    /**
     * Helper to safely save uploaded QRIS file to all storage paths
     */
    private function saveUploadedFile($file, string $folder): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $filename = Str::random(30) . '.' . $ext;

        $primaryDir = storage_path('app/public/' . $folder);
        if (!file_exists($primaryDir)) {
            @mkdir($primaryDir, 0777, true);
        }

        $primaryFile = $primaryDir . '/' . $filename;
        $file->move($primaryDir, $filename);
        @chmod($primaryFile, 0644);

        $targetDirs = [
            public_path('storage/' . $folder),
            base_path('public_html/storage/' . $folder),
            base_path('../public_html/storage/' . $folder),
            '/home/persisp1/public_html/storage/' . $folder,
        ];

        foreach ($targetDirs as $dir) {
            if ($dir !== $primaryDir) {
                if (!file_exists($dir)) {
                    @mkdir($dir, 0777, true);
                }
                if (file_exists($dir)) {
                    $dest = $dir . '/' . $filename;
                    @copy($primaryFile, $dest);
                    @chmod($dest, 0644);
                }
            }
        }

        return '/storage/' . $folder . '/' . $filename;
    }

    /**
     * Display list of donations
     */
    public function index(Request $request)
    {
        $query = Donation::with('digitalBook')->latest();

        $search = trim((string) $request->input('search', ''));
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_phone', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhereHas('digitalBook', function ($b) use ($search) {
                      $b->where('title', 'like', "%{$search}%");
                  });
            });
        }

        $status = $request->input('status');
        if (!empty($status) && $status !== 'all') {
            $query->where('status', $status);
        }

        $method = $request->input('method');
        if (!empty($method) && $method !== 'all') {
            $query->where('payment_method', $method);
        }

        $donations = $query->paginate(15)->withQueryString();

        $stats = [
            'total_amount'    => Donation::where('status', 'confirmed')->sum('amount'),
            'all_amount'      => Donation::sum('amount'),
            'total_donors'    => Donation::count(),
            'confirmed_count' => Donation::where('status', 'confirmed')->count(),
            'pending_count'   => Donation::where('status', 'pending')->count(),
            'qris_count'      => Donation::where('payment_method', 'qris')->count(),
            'transfer_count'  => Donation::where('payment_method', 'transfer')->count(),
        ];

        return view('admin.donations.index', compact('donations', 'stats', 'search', 'status', 'method'));
    }

    /**
     * Toggle or update donation status
     */
    public function updateStatus(Request $request, Donation $donation)
    {
        $newStatus = $request->input('status');
        if (!in_array($newStatus, ['pending', 'confirmed'])) {
            $newStatus = $donation->status === 'confirmed' ? 'pending' : 'confirmed';
        }

        $donation->status = $newStatus;
        $donation->save();

        return back()->with('success', "Status donasi dari {$donation->donor_name} berhasil diubah menjadi " . strtoupper($newStatus));
    }

    /**
     * Delete donation record
     */
    public function destroy(Donation $donation)
    {
        $name = $donation->donor_name;
        $donation->delete();

        return back()->with('success', "Data donasi dari {$name} berhasil dihapus.");
    }

    /**
     * Donation Settings Page (QRIS, Bank Account, Texts)
     */
    public function settings()
    {
        $settings = [
            'donation_active'       => SiteSetting::get('donation_active', '1'),
            'donation_title'        => SiteSetting::get('donation_title', 'Dukung Penerbitan Buku Islam'),
            'donation_desc'         => SiteSetting::get('donation_desc', 'Buku ini dapat diakses dan diunduh secara digital. Jika buku ini bermanfaat bagi Anda, mari ikut mendukung Persis Pers agar dapat terus menerbitkan dan menyebarluaskan karya-karya keislaman.'),
            'donation_qris_image'   => SiteSetting::get('donation_qris_image', ''),
            'donation_bank_name'    => SiteSetting::get('donation_bank_name', 'Bank Syariah Indonesia (BSI)'),
            'donation_bank_account' => SiteSetting::get('donation_bank_account', '7148888999'),
            'donation_bank_holder'  => SiteSetting::get('donation_bank_holder', 'PENERBIT PERSIS DONASI'),
            'donation_wa_contact'   => SiteSetting::get('donation_wa_contact', '6285978006263'),
        ];

        return view('admin.donations.settings', compact('settings'));
    }

    /**
     * Update Donation Settings
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'donation_active'       => 'nullable|string',
            'donation_title'        => 'required|string|max:200',
            'donation_desc'         => 'required|string|max:1000',
            'donation_qris_image'   => 'nullable|string',
            'donation_qris_file'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'donation_bank_name'    => 'required|string|max:100',
            'donation_bank_account' => 'required|string|max:50',
            'donation_bank_holder'  => 'required|string|max:150',
            'donation_wa_contact'   => 'required|string|max:50',
        ]);

        if ($request->hasFile('donation_qris_file')) {
            $validated['donation_qris_image'] = $this->saveUploadedFile($request->file('donation_qris_file'), 'qris');
        }
        unset($validated['donation_qris_file']);

        $validated['donation_active'] = $request->has('donation_active') ? '1' : '0';

        foreach ($validated as $key => $val) {
            SiteSetting::set($key, $val ?? '');
        }

        return back()->with('success', 'Pengaturan QRIS, Rekening Bank, dan Teks Donasi berhasil disimpan!');
    }
}
