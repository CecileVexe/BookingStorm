<x-layout>
    <h1 class="text-6xl font-bold"> Panier </h1>
    @if($orderItems->count() === 0)
    <h2 class="text-4xl">Votre panier est vide, vous n'avez pas envie de lire ?</h2>
    @else
    <div class="flex flex-row-reverse place-content-around">
<div class="flex flex-col">
    <h2 class="text-4xl">Total : {{$cart->total/100}} €</h2>
<form method="post" action="{{route("cart.complete")}}">
    @csrf
     <input name="order_id" hidden="true" type="text" value="{{$cart->id}}">
    <button type="submit"> Payer </button>
</form>
</div>
<div>
@foreach ($orderItems as $orderItem)
@php
$book = $orderItem->book
@endphp
<div class=" flex flex-row place-content-between items-center p-5">
<div class="flex flex-row gap-5 items-center">
    <img src="{{asset("storage/covers/$book->cover")}}" alt="couverture de {{$book->title}}" class="w-20 aspect-book object-cover rounded-lg shadow-lg mb-4"/>
    <h3>{{$book->title}}</h3> 
</div>
<div class="flex flex-row place-content-around gap-5 items-center">
   <p>Quantité : {{$orderItem->quantity}}<p>
    <p>Prix unitaire : {{$orderItem->price /100}} €</p>
     <p>Prix total : {{$orderItem->price /100 * $orderItem->quantity}} €</p>
   </div>

   <form method="post" action="{{route("cart.remove", ["orderItem"=>$orderItem->id])}}">
     @method("DELETE")
    @csrf
    <button type="submit"> Supprimer </button>
</form>
</div>
@endforeach
</div>
    </div>
    @endif
</x-layout>