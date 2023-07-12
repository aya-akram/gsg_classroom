@include('partiels.header')

    <div class="container">
    <h1>Create Topics</h1>

<form action="{{route('topics.store')}}" method="post">
    {{--
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    {{csrf_field()}}
    --}}
    @csrf
    <div class="form-floating mb-3">
  <input type="text" class="form-control" id="name" name="name" placeholder="Topic Name">
  <label for="floatingInput">topic Name</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="classroom_id" name="classroom_id" placeholder="classroom_id">
  <label for="floatingPassword">classroom id</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="user-id" name="user_id" placeholder="user-id">
  <label for="floatingPassword">user id</label>
</div>

<button type="submit" class="btn btn-primary">Create topic</button>
</form>
</div>
@include('partiels.footer')
