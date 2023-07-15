<div class="form-floating mb-3">
  <input type="text" @class(['form-control','is-invalid' =>$errors->has('name')])  value="{{old('name',$classroom->name)}}" id="name" name="name" placeholder="Class Name">
  <label for="floatingInput">class Name</label>
  @error('name')
  <div class="invalid-feedback">{{$message}}</div>
  @enderror
</div>
<div class="form-floating mb-3">
  <input type="text"  @class(['form-control','is-invalid' =>$errors->has('section')]) value="{{old('section',$classroom->name)}}" id="section" name="section" placeholder="Section">
  <label for="floatingPassword">Section</label>
  @error('section')
  <div class="invalid-feedback">{{$message}}</div>
  @enderror
</div>
<div class="form-floating mb-3">
  <input type="text"  @class(['form-control','is-invalid' =>$errors->has('subject')]) value="{{old('subject',$classroom->name)}}" id="subject" name="subject" placeholder="Subject">
  <label for="floatingPassword">Subject</label>
  @error('subject')
  <div class="invalid-feedback">{{$message}}</div>
  @enderror
</div>
<div class="form-floating mb-3">
  <input type="text"  @class(['form-control','is-invalid' =>$errors->has('room')]) value="{{old('room',$classroom->name)}}" id="room" name="room" placeholder="room">
  <label for="floatingPassword">Room</label>
  @error('room')
  <div class="invalid-feedback">{{$message}}</div>
  @enderror
</div>
<div class="form-floating mb-3">
    @if ($classroom->cover_image_path)
    {{--<img src="{{Storage::disk('public')->url($classroom->cover_image_path)}}">--}}
    <img src="{{asset('storage/' .$classroom->cover_image_path)}}" >

{{--<img src="{{ storage::disk('public')->url($classroom->cover_image_path) }}">--}}
    @endif
  <input type="file"  @class(['form-control','is-invalid' =>$errors->has('cover_image')])  id="cover_image" name="cover_image" placeholder="cover_image">
  <label for="floatingPassword">Cover Image</label>
  @error('cover_image')
  <div class="invalid-feedback">{{$message}}</div>
  @enderror
</div>
<button type="submit" class="btn btn-primary">{{$button_label}}</button>
