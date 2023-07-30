@include('partiels.header')

<div class="container">
    <h1>Trashed Topics</h1>
    <div class="row">

        <div class="col-md-3">
            <h6>All topics</h6>
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

                    <form action="{{route('topics.restore',$topic->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-success">Restore</button>
                    </form>
                    </div>
                    <div class="col-md-3">
                    <form action="{{route('topics.forceDelete',$topic->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">Delete Forever</button>
                    </form>
                    </div>
                    </div>

                    </div>

        @endforeach
        </div>
    </div>

</div>

@include('partiels.footer')
