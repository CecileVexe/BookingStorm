<x-layout>
   {{-- @dump($errors); --}}
    <div class="container mx-auto mt-10">
        <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data"> {{--enctype for enabled file post--}}
            @csrf
            <div>
                <label for="title" class="block text-sm font-semibold leading-6 text-gray-900">Titre</label>
                @error("title")
                <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="mt-2.5">
                    <input type="text" name="title" id="title" value="{{old("title")}}" class="block border w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="resume" class="block text-sm font-semibold leading-6 text-gray-900">Résumé</label>
                  @error("resume")
                <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="mt-2.5">
                    <textarea name="resume" id="resume" class="block border w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{old("resume")}}</textarea>
                </div>
            </div>
            <div>
                <label for="published_at" class="block text-sm font-semibold leading-6 text-gray-900">Date de publication</label>
                  @error("published_at")
                <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="mt-2.5">
                    <input type="date" name="published_at" id="published_at" value="{{old("published_at")}}" class="block border w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="cover" class="block text-sm font-semibold leading-6 text-gray-900">Couverture</label>
                  @error("cover")
                <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="mt-2.5">
                    <input type="file" name="cover" id="cover" value="{{old("cover")}}" class="block border w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="price" class="block text-sm font-semibold leading-6 text-gray-900">Prix</label>
                 @error("price")
                <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="mt-2.5">
                    <input type="number" min="0" name="price" id="price" value="{{old("price")}}" class="block border w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

          
             <div>
                <label for="editor_id" class="block text-sm font-semibold leading-6 text-gray-900">Editeur</label>
                  @error("editor_id")
                <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="mt-2.5">
                    <select  name="editor_id" id="editor_id" placeholder="Selectionnez un éditeur" class="block border w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                @foreach($editors as $editor)
                    <option value="{{$editor->id}}"@if(old("editor_id")==$editor->id)selected @endif>{{$editor->name}}</option>
                @endforeach
                    </select>
                    </div>
                    
            </div>
 
            <div class="mt-10">
                <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Créer
                </button>
            </div>
        </form>
    </div>
</x-layout>