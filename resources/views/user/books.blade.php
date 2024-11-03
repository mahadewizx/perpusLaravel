@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- User Menu -->
        <div class="mb-4">
            <h2 class="text-center" style="color: #333;">User Menu</h2>
            <div class="d-flex justify-content-center">
                <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary mx-2">Profil Saya</a>
                <a href="{{ route('user.borrowed_books') }}" class="btn btn-outline-secondary mx-2">Buku Dipinjam</a>
                <a href="{{ route('user.history') }}" class="btn btn-outline-secondary mx-2">Riwayat Peminjaman</a>

                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" class="mx-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>

        <h1 class="mb-4 text-center" style="color: #333;">Daftar Buku</h1>

        <!-- Pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach ($books as $book)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm" style="border: 1px solid #ccc; transition: all 0.3s;">
                        <div class="card-body">
                            <!-- Judul Buku -->
                            <h5 class="card-title text-center" style="color: #333; font-weight: bold;">
                                {{ $book->title }}
                            </h5>
                            <hr style="border-color: #333;">

                            <!-- Informasi Buku -->
                            <p><strong>Penulis:</strong> {{ $book->author }}</p>
                            <p><strong>Tahun:</strong> {{ $book->year }}</p>
                            <p><strong>Genre:</strong> {{ $book->genre }}</p>
                            <p><strong>Stok:</strong> {{ $book->stock }}</p>

                            <!-- Tombol Pinjam atau Login -->
                            <div class="d-flex justify-content-center">
                                @auth
                                    <form action="{{ route('user.borrow', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn w-100 text-white" 
                                            style="background-color: #555; border-color: #555; transition: background-color 0.3s;">
                                            Pinjam
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100">Login untuk Meminjam</a>
                                @endauth
                            </div>

                            <!-- Tombol Kembalikan (Jika buku sudah dipinjam) -->
                            @if ($book->isBorrowedByUser(auth()->id()))
                                <div class="d-flex justify-content-center mt-3">
                                    <form action="{{ route('user.return', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100">Kembalikan</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            border-color: #888;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
@endsection
