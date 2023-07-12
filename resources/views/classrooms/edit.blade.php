@include('partiels.header')

    <div class="container">
    <h1>Edit Classroom</h1>

<form action="{{route('classrooms.update',$classroom->id)}}" method="post">
    {{--
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    {{csrf_field()}}
    --}}
    @csrf
    <!-- Form Method Sppofing -->
    {{-- <input type="hidden" name="_method" value="put">
    {{method_field('put')}}
    --}}
    @method('put')

    <div class="form-floating mb-3">
  <input type="text" class="form-control" id="name" value="{{$classroom->name}}" name="name" placeholder="Class Name">
  <label for="floatingInput">class Name</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="section" name="section" value="{{$classroom->section}}"placeholder="Section">
  <label for="floatingPassword">Section</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="subject" name="subject" value="{{$classroom->subject}}" placeholder="Subject">
  <label for="floatingPassword">Subject</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="room" name="room" value="{{$classroom->room}}" placeholder="room">
  <label for="floatingPassword">Room</label>
</div>
<div class="form-floating mb-3">
  <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="cover_image">
  <label for="floatingPassword">Cover Image</label>
</div>
<button type="submit" class="btn btn-primary">Update classroom</button>
</form>
</div>
@include('partiels.footer')
