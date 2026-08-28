<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $search = $search ? str_replace(['%', '_'], ['\%', '\_'], $search) : null;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('service')) {
            $query->where('service_category', $request->service);
        }

        $messages = $query->latest()->paginate(10)->withQueryString();
        $pendingCount = ContactMessage::where('status', 'pending')->count();

        return view('admin.messages.index', compact('messages', 'pendingCount'));
    }

    public function show(ContactMessage $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function update(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,contacted,completed'],
            'notes' => ['nullable', 'string'],
        ]);

        $message->update($validated);

        return back()->with('success', 'Status pesan pengajuan berhasil diperbarui.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
