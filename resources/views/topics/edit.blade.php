@include('partiels.header')

    <div class="container">
    <h1>Edit Topic</h1>

<form action="{{route('classrooms.topics.update',['classroom' => $classroom,'topic'=>$topic])}}" method="post">

    @csrf

    @method('put')

   @include('topics._form',[
    'button_label' => 'Update topic'])
</form>
</div>
@include('partiels.footer')
