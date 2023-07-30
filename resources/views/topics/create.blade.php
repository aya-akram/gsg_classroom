@include('partiels.header')

    <div class="container">
    <h1>Create Topics</h1>
     @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error )
            <li>{{$error}}</li>

        @endforeach
</ul>
    </div>

    @endif

<form action="{{route('classrooms.topics.store',['classroom' => $classroom])}}" method="post">
    {{--
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    {{csrf_field()}}
    --}}
    @csrf
   @include('topics._form',[
    'button_label' => 'Create topic'])
</form>
</div>
@include('partiels.footer')
