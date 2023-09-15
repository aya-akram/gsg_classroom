@props([
    'classroom'
    ])

<div class="card">
                <!-- <img src="storage/{{$classroom->cover_image_path}}" class="card-img-top" alt=""> -->
               <!-- <img src="{{Storage::disk('public')->url($classroom->cover_image_path) }}" class="card-img-top" alt=""> -->
               <img src="{{$classroom->cover_image_url }}" class="card-img-top" alt="">

                <div class="card-body">
                    <h5 class="card-title">{{$classroom->name}}</h5>
                    <p class="card-text">{{$classroom->section}} - {{$classroom->room}}</p>

                    <div class="d-flex flex-row">
                    <div class="col-md-3">
                    <a href="{{$classroom->url}}" ><i class="fa fa-eye" style="color:cadetblue"></i></a>
                    </div>
                    <div class="col-md-3" >
                    <a href="{{route('classrooms.edit',$classroom->id)}}" ><i class="fa fa-edit" style="color:green"></i></a>

                    </div>
                    <div class="col-md-3">
                    <form action="{{route('classrooms.destroy',$classroom->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <a>
                        <button type="submit" style="border: none; background: transparent;">
                            <i class="fa fa-trash" style="color:red"></i>
                        </button>
                    </a>
                 </form>
                    </div>
                    </div>

                </div>
            </div>
