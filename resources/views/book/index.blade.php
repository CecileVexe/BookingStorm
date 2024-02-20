<x-layout>
    <x-slot:title>
        Nos derniers arrivages
    </x-slot:title>
 
    <div class="container mx-auto">
        <h1 class="text-4xl p-6 font-bold">Notre catalogue</h1>
      @if($category)
        <h2>{{$category->name}}</h2>
        <p>{{$category->description}}</p>
      @endif
        <div class="grid grid-cols-5 grid-cols-5 gap-6">
            @foreach ($books as $book)
                <div class="flex flex-col">
                    <img src="{{asset("storage/covers/$book->cover")}}" class="w-full aspect-book object-cover rounded-lg shadow-lg mb-4"/>
                    <div class="flex items-center gap-x-4 text-xs">
                        <time datetime="{{ $book->published_at }}" class="text-gray-500">{{ $book->published_at->format('d M Y') }}</time>
                        @foreach($book->categories as $categories)
                        <a href="#" class="relative z-10 rounded-full bg-{{$categories->color}}-50 px3 py1.5 font-medium text-{{$categories->color}}-600 hover:bg-{{$categories->color}}-100">
                            {{ $categories->name }}
                        </a>
                        @endforeach
                        <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                            {{ $book->editor->name }}
                        </a>
                    </div>
                    <div class="group relative">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <a href="{{ route('book.show', $book) }}">
                               
                                {{ $book->title }}
                            </a>
                        </h3>
                        <div>
                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-600">{{ $book->price / 100 }}€ / mois</p>
                            <form action="{{route("cart.addToCart")}}" method="post">
                                @csrf
                                <input name="book_id" hidden="true" type="text" value="{{$book->id}}">
                            <button type="submit">Ajouter au panier</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        </div>
        {{ $books->links() }}
    </div>
</x-layout>