<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=SICOE+UI:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js' rel='stylesheet'>
    <link rel="icon" href="{{ asset('images/isotipo_untrm.svg') }}" type="image/x-icon">

    <title>{{ $title ?? 'Eventos Fisme' }}</title>
    @livewireStyles
    @vite('resources/css/app.css')

</head>

<body>
    <div id="loading-screen">
        <div class="min-h-60 flex flex-col  shadow-sm rounded-xl dark:bg-neutral-800  dark:shadow-neutral-700/70">
            <div class="flex flex-auto flex-col justify-center items-center p-4 md:p-5">
              <div class="flex justify-center">
                <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                  <span class="sr-only">Loading...</span>
                </div>
              </div>
            </div>
          </div>
    </div>
    @livewire('partials.navbar')
    <main>
        {{ $slot }}
    </main>
    @livewire('partials.footer')
    {{-- @livewire('cookie-consent') --}}


    @vite('resources/js/app.js')

    <script src=" {{ asset('js/app.js') }}"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 1000,
        });

        let originalTitle = document.title;

        window.addEventListener('blur', function() {
            document.title = "No te vayas sin inscribirte 😢";
        });


        window.addEventListener('focus', function() {
            document.title = originalTitle;
        });
    </script>


</body>

</html>
