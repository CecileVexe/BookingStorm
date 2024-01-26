<x-layout>
    <x-slot:title>
        Nos derniers arrivages
    </x-slot:title>
 
    <div class="container mx-auto">
        <h1 class="text-4xl p-6 font-bold">Notre catalogue</h1>
 
        <div class="grid grid-cols-5 grid-cols-5 gap-6">
            @foreach ($books as $book)
                <div class="flex flex-col">
                    <img src="{{ $book->cover }}" class="w-full aspect-book object-cover rounded-lg shadow-lg mb-4"/>
                    <div class="flex items-center gap-x-4 text-xs">
                        <time datetime="{{ $book->published_at }}" class="text-gray-500">{{ $book->published_at->format('d M Y') }}</time>
                        <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                            {{ $book->editor->name }}
                        </a>
                    </div>
                    <div class="group relative">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <a href="{{ route('book.show', $book) }}">
                                <span class="absolute inset-0"></span>
                                {{ $book->title }}
                            </a>
                        </h3>
                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-600">{{ $book->price / 100 }}€ / mois</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>