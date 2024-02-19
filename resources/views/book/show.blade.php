<x-layout>
  
    <h1>{{$book->title}}</h1>
    <img src="{{asset("storage/covers/$book->cover")}}" alt="couverture {{$book->title}}" class="w-40" />
                <div class="p-2">
                <p>Publié le {{$book->published_at->format("d/m/Y")}} par {{$book->editor->name}}</p>
                <button class="bg-indigo-800 p-2 rounded text-white"><a href="{{route("book.edit", $book)}}">Modifer</a></button>
                <form method="post" action="{{route('book.destroy', $book)}}">
                    @method("DELETE")
                    @csrf 
                <button type="submit" class="bg-indigo-800 p-2 rounded text-white"  onsubmit="return confirm('Voulez vous vraiment supprimer cette book ?')">Supprimer</button>
                </form>
                <a href="{{route("book.pdf", $book)}}"  class="bg-indigo-800 p-2 rounded text-white">Télécharger</a>
            </div>
    
</x-layout>