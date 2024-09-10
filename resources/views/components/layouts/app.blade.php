<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=SICOE+UI:wght@400;700&display=swap" rel="stylesheet">

    <title>{{ $title ?? 'Eventos Fisme' }}</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body>
    @livewire('partials.navbar')
    <main>
        {{ $slot }}
    </main>
    @livewire('partials.footer')
    @livewireScripts

    @vite('resources/js/app.js')


    <script src=" {{ asset('js/app.js') }}"></script>
   
</body>

</html>
