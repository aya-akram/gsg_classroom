<!doctype html>
<html dir="{{App::isLocale('ar')? 'rtl' : 'ltr'}}" lang="{{App::currentLocale()}}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    @if (App::isLocal('ar'))
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>
  <body>
    <header class="mb-5">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
 {{-- <img src="{{asset('assets/images/googleclasroom.jpeg')}}" width="50">
    <a class="navbar-brand" href="{{route('home')}}">{{config('app.name','Laravel')}}</a> --}}
    <a class="navbar-brand" href="{{route('home')}}">{{config('app.name','Laravel')}}</a>

    <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{asset('assets/images/googleclasroom.jpeg')}}" width="50">
          </a>
          <ul class="dropdown-menu text-small" style="">
            <li><a class="navbar-brand" href="{{route('classrooms.create')}}">Create Classroom</a></li>
            <li><a class="navbar-brand" href="{{route('classrooms.trashed')}}">Trashed Classroom</a></li>
            <li><a class="navbar-brand" href="{{route('topics.trashed')}}">Trashed Topic</a></li>





          </ul>
          <x-user-notification-menu count="5"/>
        </div>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">

     {{-- <div>
        {{Auth::user()->name}}
      </div>
      --}}

    </div>
  </div>
</nav>
    </header>
    <main>
           {{$slot}}
    </main>


<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <svg class="bi" width="30" height="24">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>
        <span class="mb-3 mb-md-0 text-body-secondary">© 2023 {{config('app.name')}}</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                    <use xlink:href="#twitter"></use>
                </svg></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                    <use xlink:href="#instagram"></use>
                </svg></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                    <use xlink:href="#facebook"></use>
                </svg></a></li>
    </ul>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
    var classroomId;
    const userId = "{{Auth::id()}}";
    </script>
@stack('scripts')
@vite(['resources/js/app.js'])

</body>

</html>
