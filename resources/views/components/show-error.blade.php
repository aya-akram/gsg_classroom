@php
    $name = str_replace('[','.',$name);
    $name = str_replace(']','',$name);

@endphp
@props([
    'name'
    ])

@error($name)
  <div class="invalid-feedback">{{$message}}</div>
  @enderror
