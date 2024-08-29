<div>
    <!-- Header -->
    <header class="flex justify-between items-center p-4">
        <img src="/path-to-logo.png" alt="Agenda PUCP" class="h-12">
        <div class="relative">
            <input wire:model="searchTerm" type="text" placeholder="Buscar por palabra clave" class="border rounded-full py-2 px-4 pr-10">
            <button wire:click="search" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white rounded-full p-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </div>
    </header>

    <!-- Slider -->
    <div class="relative h-96 bg-navy-blue text-white">
        <div class="absolute inset-0">
            <img src="{{ $slides[$currentSlide]->image }}" alt="{{ $slides[$currentSlide]->title }}" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-2">{{ $slides[$currentSlide]->date }}</h2>
                <h1 class="text-5xl font-bold mb-4">{{ $slides[$currentSlide]->title }}</h1>
                <button class="bg-blue-500 text-white px-6 py-2 rounded-full">MÁS INFORMACIÓN</button>
            </div>
        </div>
        <button wire:click="prevSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 rounded-full p-2">
            <!-- Left arrow SVG -->
        </button>
        <button wire:click="nextSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 rounded-full p-2">
            <!-- Right arrow SVG -->
        </button>
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
            @foreach($slides as $index => $slide)
                <button wire:click="$set('currentSlide', {{ $index }})" class="w-3 h-3 rounded-full {{ $index === $currentSlide ? 'bg-blue-500' : 'bg-white bg-opacity-50' }}"></button>
            @endforeach
        </div>
    </div>

    <!-- Próximos eventos -->
    <section class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6">Próximos eventos</h2>
        <div class="flex justify-between mb-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded">FECHAS</button>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">TIPO</button>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">ÁREA</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="relative">
                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                    <div class="absolute bottom-0 right-0 bg-blue-500 text-white p-4">
                        <span class="text-4xl font-bold">{{ $event->day }}</span>
                        <span class="uppercase">{{ $event->month }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
<script>
    const slides = [{
            image: 'images/cap1.png',
            title: 'Congreso Academico',
            date: 'Octubre 10'
        },
        {
            image: 'images/cap2.png',
            title: 'Evento 2',
            date: 'Fecha 2'
        },

    ];

    let currentSlide = 0;

    function showSlide(index) {
        const slide = slides[index];
        document.getElementById('slide-image').src = slide.image;
        document.getElementById('slide-title').textContent = slide.title;
        document.getElementById('slide-date').textContent = slide.date;

        document.querySelectorAll('.indicator').forEach((indicator, i) => {
            indicator.classList.toggle('bg-blue-500', i === index);
            indicator.classList.toggle('bg-white', i !== index);
        });
    }

    document.getElementById('next-slide').addEventListener('click', () => {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    });

    document.getElementById('prev-slide').addEventListener('click', () => {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    });

    // Initialize the slider
    showSlide(currentSlide);
</script>
