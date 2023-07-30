@props([
    'name'
    ])
@php
    $class= $name == 'error'? 'danger' : 'success';
@endphp
@if(session($name))
<div class="alert alert-{{$class}}">
  {{session($name)}}
    </div>

   
@endif
