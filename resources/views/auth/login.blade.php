@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-6" style="max-width: 450px;">
            <div class="card shadow-lg rounded">
                <div class="card-header text-center" style="background-color: #00796b; color: white;">
                    <h2>Login</h2>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="Enter your email" style="padding: 12px;">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Enter your password" style="padding: 12px;">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block text-white" style="padding: 12px; font-size: 16px;">Login</button>
                    </form>

                    <!-- "Don't have an account?" link -->
                    <div class="text-center mt-4">
                        <p>Don't have an account? <a href="{{ route('register') }}" style="color: #00796b; text-decoration: underline;">Register here</a></p>
                    </div>
                </div>

                <!-- Message after failed login -->
                @if (session('error'))
                    <div class="alert alert-danger mt-4 text-center">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Full background gradient */
    body {
        background: linear-gradient(135deg, #e0f7fa, #80deea);
    }

    .form-control {
        border: 1px solid #00796b;
        transition: box-shadow 0.3s ease-in-out;
    }
    .form-control:focus {
        box-shadow: 0 0 8px rgba(0, 121, 107, 0.5);
        border-color: #00796b;
    }
    .btn-primary {
        background-color: #00796b;
        border: none;
        transition: background-color 0.3s ease-in-out;
    }
    .btn-primary:hover {
        background-color: #004d40;
    }
</style>
@endsection
