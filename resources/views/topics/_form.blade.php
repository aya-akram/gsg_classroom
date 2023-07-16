
    <div class="form-floating mb-3">
  <input type="text"  @class(['form-control','is-invalid' =>$errors->has('name')])  value="{{old('name',$topic->name)}}" id="name" name="name" placeholder="Topic Name">
  <label for="floatingInput">topic Name</label>
  @error('name')
  <div class="invalid-feedback">{{$message}}</div>
  @enderror
</div>
<div class="form-floating mb-3">
  <input type="text" @class(['form-control','is-invalid' =>$errors->has('classroom_id')])  value="{{old('classroom_id',$topic->classroom_id)}}" id="classroom_id" name="classroom_id" placeholder="classroom_id">
  <label for="floatingPassword">classroom id</label>
  @error('classroom_id')
  <div class="invalid-feedback">{{$message}}</div>
@enderror
</div>
<div class="form-floating mb-3">
  <input type="text" @class(['form-control','is-invalid' =>$errors->has('user_id')])  value="{{old('user_id',$topic->user_id)}}" id="user-id" name="user_id" placeholder="user-id">
  <label for="floatingPassword">user id</label>
@error('user_id')
  <div class="invalid-feedback">{{$message}}</div>
@enderror
</div>

<button type="submit" class="btn btn-primary">{{$button_label}}</button>
