@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center" style="color: #333;">Buku yang Sedang Dipinjam</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Tanggal Pinjam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrows as $borrow)
                <tr>
                    <td>{{ $borrow->book->title }}</td>
                    <td>{{ $borrow->book->author }}</td>
                    <td>{{ $borrow->book->year }}</td>
                    <td>{{ $borrow->borrowed_at }}</td>
                    <td>
                        <form action="{{ route('user.return', $borrow->book->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary" type="submit">Kembalikan</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }

    h1 {
        margin-bottom: 30px;
    }

    .alert {
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .table {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endsection
