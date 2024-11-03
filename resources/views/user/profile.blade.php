@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center" style="color: #333;">Profil Pengguna</h1>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <!-- Gambar Profil -->
                            <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://via.placeholder.com/150' }}" 
                                 alt="Gambar Profil" class="rounded-circle" style="width: 150px; height: 150px;">
                        </div>

                        <!-- Form Upload Foto Profil -->
                        <form action="{{ route('user.update.profile.photo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="profile_photo" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Ganti Foto Profil</button>
                        </form>

                        <h5 class="card-title" style="font-weight: bold;">Nama: {{ Auth::user()->name }}</h5>
                        <p class="text-muted"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <div class="mt-4">
                            <a href="{{ route('user.borrowed.books') }}" class="btn btn-primary">Lihat Buku yang Dipinjam</a>
                            <a href="{{ route('user.history') }}" class="btn btn-secondary">Lihat Riwayat Peminjaman</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .card img {
            border-radius: 50%;
            border: 2px solid #555;
        }

        .btn {
            margin: 0 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
@endsection
