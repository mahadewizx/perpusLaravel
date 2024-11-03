@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4" style="color: #333;">Riwayat Peminjaman</h1>

        @if ($borrows->isEmpty())
            <p class="text-center">Anda belum memiliki riwayat peminjaman.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            <tr>
                                <td>{{ $borrow->book->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d M Y') }}</td>
                                <td>
                                    {{ $borrow->returned_at ? \Carbon\Carbon::parse($borrow->returned_at)->format('d M Y') : 'Belum Dikembalikan' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
