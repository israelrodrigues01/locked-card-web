<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        /* Estilo moderno e elegante para a tela de login */
        body {
            background: radial-gradient(circle, #1e3a8a, #1e40af);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Figtree', sans-serif;
            color: white;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            max-width: 380px;
            width: 100%;
            text-align: center;
        }

        h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            outline: none;
            transition: 0.3s;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        input:focus {
            background: rgba(255, 255, 255, 0.3);
        }

        button {
            width: 100%;
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 15px;
            font-weight: bold;
        }

        button:hover {
            background: linear-gradient(135deg, #3b82f6, #4f46e5);
        }

        .forgot-password {
            display: block;
            text-align: right;
            font-size: 14px;
            color: #93c5fd;
            margin-top: 12px;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
