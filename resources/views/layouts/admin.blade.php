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
        <link rel="stylesheet" href= "{{asset('/css/style.css')}}">
        <script src="https://cdn.tiny.cloud/1/byv6maqck2gq4i6qw14bniqs5ue3hnvb3u9b58xyazdruv1o/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased">
            @if(session()->has('success'))
            <div class="success-message">
                {{ session()->get('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
            @endif
            @if (session('error'))
            <div class="error-message">
            {{ session('error') }}
            </div>
            @endif
        @include('layouts.navigation')
        @yield('content')
    </body>
</html>