@include('partiels.header')

    <div class="container">
    <h1>Create Classroom</h1>

<form action="{{route('classrooms.store')}}" method="post">
    {{--
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    {{csrf_field()}}
    --}}
    @csrf
    <div class="form-floating mb-3">
  <input type="text" class="form-control" id="name" name="name" placeholder="Class Name">
  <label for="floatingInput">class Name</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="section" name="section" placeholder="Section">
  <label for="floatingPassword">Section</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
  <label for="floatingPassword">Subject</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="room" name="room" placeholder="room">
  <label for="floatingPassword">Room</label>
</div>
<div class="form-floating mb-3">
  <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="cover_image">
  <label for="floatingPassword">Cover Image</label>
</div>
<button type="submit" class="btn btn-primary">Create room</button>
</form>
</div>
@include('partiels.footer')
