{{-- resources/views/books/edit.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .container {
            margin-top: 40px;
            padding: 25px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #003366;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            color: #003366;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #003366;
            outline: none;
            box-shadow: 0 0 4px rgba(0, 51, 102, 0.5);
        }

        button.btn {
            background-color: #003366;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            border: none;
            width: 100%;
            font-size: 16px;
        }

        button.btn:hover {
            background-color: #002244;
        }

        a.btn {
            display: block;
            text-align: center;
            background-color: #555;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
        }

        a.btn:hover {
            background-color: #333;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            button.btn,
            a.btn {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Book</h1>

        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ $book->title }}" required>

            <label for="author">Author:</label>
            <input type="text" name="author" value="{{ $book->author }}" required>

            <label for="year">Year:</label>
            <input type="number" name="year" value="{{ $book->year }}" required>

            <label for="stock">Stock:</label>
            <input type="number" name="stock" value="{{ $book->stock }}" required>

            <label for="genre">Genre:</label>
            <input type="text" name="genre" value="{{ $book->genre }}" required>

            <button type="submit" class="btn">Update Book</button>
        </form>

        <a href="{{ route('books.index') }}" class="btn">Back to Book List</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
