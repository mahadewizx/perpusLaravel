<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class UserController extends Controller
{
    // Tampilkan daftar buku yang tersedia
    public function index()
    {
        // Mengambil buku yang stoknya tersedia
        $books = Book::where('stock', '>', 0)->get();

        return view('user.books', compact('books'));
    }

    // Pinjam buku
    public function borrow($id)
    {
        $book = Book::findOrFail($id); // Pastikan buku ada

        // Periksa apakah stok buku tersedia
        if ($book->stock > 0) {
            // Kurangi stok buku
            $book->decrement('stock');

            // Catat peminjaman buku ke tabel borrow
            Borrow::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'borrowed_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        }

        return redirect()->back()->with('error', 'Stok buku habis.');
    }

    // Kembalikan buku
    public function returnBook($id)
    {
        // Cari catatan peminjaman yang belum dikembalikan
        $borrow = Borrow::where('user_id', Auth::id())
                        ->where('book_id', $id)
                        ->whereNull('returned_at')
                        ->first();

        // Jika catatan peminjaman ditemukan
        if ($borrow) {
            $book = $borrow->book;

            // Tambahkan stok buku
            $book->increment('stock');

            // Tandai bahwa buku sudah dikembalikan
            $borrow->update(['returned_at' => now()]);

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        }

        return redirect()->back()->with('error', 'Buku tidak ditemukan atau sudah dikembalikan.');
    }

    // Tampilkan buku yang sedang dipinjam oleh pengguna
    public function borrowedBooks()
    {
        // Mengambil data buku yang sedang dipinjam oleh pengguna, dengan informasi buku
        $borrows = Borrow::where('user_id', Auth::id())
                         ->whereNull('returned_at')
                         ->with('book') // Eager loading untuk mengurangi query tambahan
                         ->get();

        return view('user.borrowed_books', compact('borrows'));
    }

    // Tambahan metode untuk profil pengguna
    public function profile()
    {
        // Logika untuk menampilkan halaman profil pengguna
        return view('user.profile');
    }

    // Metode untuk menampilkan riwayat peminjaman
    public function history()
    {
        // Ambil riwayat peminjaman untuk pengguna yang sedang login
        $borrows = Borrow::where('user_id', Auth::id())->with('book')->get();

        return view('user.history', compact('borrows'));
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->profile_photo) {
            Storage::delete('public/' . $user->profile_photo);
        }

        // Simpan foto baru
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo = $path;
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
