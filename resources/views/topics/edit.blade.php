@include('partiels.header')

    <div class="container">
    <h1>Edit Topic</h1>

<form action="{{route('topics.update',$topic->id)}}" method="post">

    @csrf

    @method('put')

   @include('topics._form',[
    'button_label' => 'Update topic'])
</form>
</div>
@include('partiels.footer')
