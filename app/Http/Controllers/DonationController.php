<?php

namespace App\Http\Controllers;

use App\Models\DigitalBook;
use App\Models\Donation;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    /**
     * Helper to safely save uploaded proof image to all storage paths
     */
    private function saveProofFile($file): string
    {
        $folder = 'donations';
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $filename = 'bukti_' . time() . '_' . Str::random(16) . '.' . $ext;

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
     * Store donation from frontend modal
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'digital_book_id' => 'nullable|exists:digital_books,id',
            'donor_name'      => 'required|string|max:150',
            'donor_phone'     => 'nullable|string|max:50',
            'donor_email'     => 'nullable|email|max:150',
            'amount'          => 'required|numeric|min:1000',
            'payment_method'  => 'required|in:qris,transfer',
            'bank_name'       => 'nullable|string|max:100',
            'proof_file'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'notes'           => 'nullable|string|max:1000',
        ]);

        $proofPath = null;
        if ($request->hasFile('proof_file') && $request->file('proof_file')->isValid()) {
            $proofPath = $this->saveProofFile($request->file('proof_file'));
        }

        $bankName = $validated['bank_name'] ?? ($validated['payment_method'] === 'transfer' ? SiteSetting::get('donation_bank_name', 'Bank Syariah Indonesia (BSI)') : 'QRIS Persis Pers');

        $donation = Donation::create([
            'digital_book_id' => $validated['digital_book_id'] ?? null,
            'donor_name'      => $validated['donor_name'],
            'donor_phone'     => $validated['donor_phone'] ?? null,
            'donor_email'     => $validated['donor_email'] ?? null,
            'amount'          => $validated['amount'],
            'payment_method'  => $validated['payment_method'],
            'bank_name'       => $bankName,
            'proof_image'     => $proofPath,
            'notes'           => $validated['notes'] ?? null,
            'status'          => $proofPath ? 'confirmed' : 'pending',
        ]);

        $downloadUrl = null;
        if (!empty($validated['digital_book_id'])) {
            $book = DigitalBook::find($validated['digital_book_id']);
            if ($book && $book->pdf_url) {
                $downloadUrl = $book->pdf_url;
            }
        }

        return response()->json([
            'success'      => true,
            'message'      => 'Jazakumullah Khairan Katsiran! Donasi Anda telah kami terima dan tercatat dengan baik.',
            'donation_id'  => $donation->id,
            'download_url' => $downloadUrl,
        ]);
    }

    /**
     * Direct download endpoint for digital books
     */
    public function download($slug)
    {
        $book = DigitalBook::published()->where('slug', $slug)->first();
        if (!$book) {
            $book = DigitalBook::published()->where('id', $slug)->first();
        }

        if (!$book || empty($book->pdf_file)) {
            return redirect()->route('katalog.digital')->with('error', 'File PDF buku tidak tersedia.');
        }

        $pdfPath = $book->pdf_url;
        return redirect($pdfPath);
    }
}
