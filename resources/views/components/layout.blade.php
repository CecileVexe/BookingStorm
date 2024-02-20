<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title ?? "Pas de titre"}}</title>
    @vite( ['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!--<h1 class="text-3xl font-bold underline">
      Hello world!
    </h1>-->
   
    <x-navbar/>  <div class="mt-20 px-6 "> <x-flash/>  {{$slot}} </div>

</body>
</html>