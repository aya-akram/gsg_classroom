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

    <!-- <div {{
        $attribute->class(['alert','alert-success' => $name == 'success'])
        ->merge([
            'id' =>'alert'
            ])
    }}> {{session($name)}}</div> -->
@endif
