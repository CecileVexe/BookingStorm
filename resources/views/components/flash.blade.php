@if(session()->has("success"))
<div class="border border-green-400 bg-green-100 rounded-lg p-4 mb-4">
    {{session("success")}}
</div>
@endif

@if(session()->has("error"))
<div class="border border-red-400 bg-red-100 rounded-lg p-4 mb-4">
    {{session("error")}}
</div>
@endif