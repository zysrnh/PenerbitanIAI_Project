<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Book;

class CartController extends Controller
{
    /**
     * Get all cart items for authenticated member.
     */
    public function index()
    {
        $userId = Auth::id();
        $cartItems = CartItem::with('book')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return response()->json($this->formatCartResponse($cartItems));
    }

    /**
     * Add a book to member's cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'book_id'  => ['required', 'exists:books,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $userId = Auth::id();
        $bookId = $request->input('book_id');
        $qty = (int)$request->input('quantity', 1);

        $cartItem = CartItem::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $qty);
        } else {
            $cartItem = CartItem::create([
                'user_id'  => $userId,
                'book_id'  => $bookId,
                'quantity' => $qty,
            ]);
        }

        $cartItems = CartItem::with('book')->where('user_id', $userId)->latest()->get();
        $book = Book::find($bookId);

        return response()->json(array_merge($this->formatCartResponse($cartItems), [
            'success' => true,
            'message' => 'Buku "' . ($book ? $book->title : 'Buku') . '" berhasil ditambahkan ke keranjang.',
        ]));
    }

    /**
     * Update quantity of a cart item.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $userId = Auth::id();
        $qty = (int)$request->input('quantity');

        $cartItem = CartItem::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        if ($qty <= 0) {
            $cartItem->delete();
        } else {
            $cartItem->update(['quantity' => $qty]);
        }

        $cartItems = CartItem::with('book')->where('user_id', $userId)->latest()->get();

        return response()->json(array_merge($this->formatCartResponse($cartItems), [
            'success' => true,
            'message' => 'Jumlah pesanan berhasil diperbarui.',
        ]));
    }

    /**
     * Remove a single item from cart.
     */
    public function remove($id)
    {
        $userId = Auth::id();
        $cartItem = CartItem::where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        $cartItems = CartItem::with('book')->where('user_id', $userId)->latest()->get();

        return response()->json(array_merge($this->formatCartResponse($cartItems), [
            'success' => true,
            'message' => 'Item berhasil dihapus dari keranjang.',
        ]));
    }

    /**
     * Clear all items from cart.
     */
    public function clear()
    {
        $userId = Auth::id();
        CartItem::where('user_id', $userId)->delete();

        return response()->json([
            'success'          => true,
            'count'            => 0,
            'total'            => 0,
            'formatted_total'  => 'Rp 0',
            'items'            => [],
            'message'          => 'Keranjang belanja telah dikosongkan.',
        ]);
    }

    /**
     * Helper to format standardized cart JSON response.
     */
    private function formatCartResponse($cartItems): array
    {
        $totalItems = 0;
        $totalAmount = 0;
        $formattedItems = [];

        foreach ($cartItems as $item) {
            if (!$item->book) continue;

            $totalItems += (int)$item->quantity;
            $totalAmount += $item->subtotal;

            $coverUrl = null;
            if ($item->book->cover_image) {
                if (file_exists(public_path('storage/' . $item->book->cover_image))) {
                    $coverUrl = asset('storage/' . $item->book->cover_image);
                } elseif (file_exists(public_path('images/' . $item->book->cover_image))) {
                    $coverUrl = asset('images/' . $item->book->cover_image);
                }
            }

            $formattedItems[] = [
                'id'                 => $item->id,
                'book_id'            => $item->book_id,
                'title'              => $item->book->title,
                'author'             => $item->book->author,
                'category'           => $item->book->category ?? 'Buku Ajar',
                'cover_url'          => $coverUrl,
                'quantity'           => (int)$item->quantity,
                'unit_price'         => $item->numeric_price,
                'formatted_price'    => $item->formatted_price,
                'subtotal'           => $item->subtotal,
                'formatted_subtotal' => $item->formatted_subtotal,
            ];
        }

        return [
            'success'         => true,
            'count'           => $totalItems,
            'total'           => $totalAmount,
            'formatted_total' => 'Rp ' . number_format($totalAmount, 0, ',', '.'),
            'items'           => $formattedItems,
        ];
    }
}
