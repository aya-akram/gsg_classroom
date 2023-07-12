@include('partiels.header')

    <div class="container">
    <h1>Edit Topic</h1>

<form action="{{route('topics.update',$topic->id)}}" method="post">

    @csrf

    @method('put')

    <div class="form-floating mb-3">
  <input type="text" class="form-control" id="name" value="{{$topic->name}}" name="name" placeholder="Topic Name">
  <label for="floatingInput">topic Name</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="user_id" name="user_id" value="{{$topic->user_id}}"placeholder="user_id">
  <label for="floatingPassword">user_id</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="classroom_id" name="classroom_id" value="{{$topic->classroom_id}}" placeholder="classroom_id">
  <label for="floatingPassword">Classroom_id</label>
</div>

<button type="submit" class="btn btn-primary">Update topic</button>
</form>
</div>
@include('partiels.footer')
