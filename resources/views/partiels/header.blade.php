<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title',config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <header class="mb-5">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <img src="{{asset('assets/images/googleclasroom.jpeg')}}" width="50">
    <a class="navbar-brand" href="{{route('home')}}">{{config('app.name','Laravel')}}</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

     {{-- <div>
        {{Auth::user()->name}}
      </div>
      --}}

    </div>
  </div>
</nav>
    </header>
