<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        /* Genel Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body, html {
            height: 100%;
            background-color: #000; /* Siyah arkaplan */
            color: #fff;
        }

        .container {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        .left-side {
            flex: 2; /* 2/3 oranı */
            background: url('/path/to/logo-or-background.jpg') no-repeat center center;
            background-size: contain;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            /* Eğer sadece logo kullanılacaksa aşağıdaki img tag ile değiştirebiliriz */
        }

        .left-side img {
            max-width: 80%;
            height: auto;
        }

        .right-side {
            flex: 1; /* 1/3 oranı */
            background-color: #111; /* Koyu gri / siyah arkaplan, formu öne çıkarır */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem;
        }

        form {
            width: 100%;
            max-width: 320px;
        }

        h1 {
            margin-bottom: 2rem;
            font-weight: 600;
            font-size: 2rem;
            text-align: center;
            color: #fff;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #0d6efd; /* Bootstrap mavi tonu */
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }

        button:hover {
            background-color: #0b5ed7;
        }

        .error-messages {
            background-color: #b91c1c; /* kırmızı ton */
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <!-- Logo için resim yerleştir -->
            <img src="{{ asset('images/turuncu-basim.png') }}" alt="Firma Logosu">
        </div>
        <div class="right-side">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf
                <h1>Giriş Yap</h1>

                @if ($errors->any())
                    <div class="error-messages">
                        <ul>
                            @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required autofocus>

                <label for="password">Şifre:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Giriş</button>
            </form>
        </div>
    </div>
</body>
</html>

