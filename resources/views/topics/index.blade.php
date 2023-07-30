@include('partiels.header')

<div class="container">
    <h1>Topics</h1>
    <div class="row">

        <div class="col-md-3">
            <h6>All topics</h6>
            <div class="col-md-4">
                    <a href="{{route('topics.trashed')}}" class="btn btn-sm btn-success">Trashed Topic</a>
           </div>
            <div class="col-md-3">
            @foreach ($topics as $topic )
            <p>{{$topic->name}}</p>
            @endforeach

            </div>



        </div>

        <div class="col p-3">
        @foreach ($topics as $topic )

        <h5 class="card-title">{{$topic->name}}</h5>
                   <hr>
                    <p class="card-text">Classroom_id:{{$topic->classroom_id}} , User_id:{{$topic->user_id}}</p>
                    <div class="row">
                    <div class="col-md-1">
                    <a href="{{route('classrooms.topics.show',['classroom' => $classroom,'topic'=>$topic])}}" class="btn btn-sm btn-primary">View</a>
                    </div>
                    <div class="col-md-1">
                    <a href="{{route('classrooms.topics.edit',['classroom' => $classroom,'topic'=>$topic])}}" class="btn btn-sm btn-dark">Edit</a>
                    </div>
                    <div class="col-md-1">
                     <form action="{{ route('classrooms.topics.destroy', ['classroom' => $classroom, 'topic' => $topic])}}" method="post">

                     @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger m-1">Delete</button>
                    </form>
                    </div>

                    </div>

        @endforeach
        </div>
    </div>

</div>

@include('partiels.footer')
