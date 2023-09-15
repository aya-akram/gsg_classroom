<x-main-layout :title="$classroom->name">
    <div class="container">

        <div class="card text-bg-dark">
    <img src="{{$classroom->cover_image_url }}" class="card-img-top" alt="">
    <div class="card-img-overlay d-flex flex-column-reverse">
    <h3 class="p-2">{{$classroom->section}}</h3>

    <h1 class="p-2">{{ $classroom->name }} (#{{ $classroom->id }}</h1>
    </div>
    </div>
        <x-alert name="success" class="alert-success" />
        <x-alert name="error" class="alert-danger" />


        <hr>
        <h4>{{$classwork->title}}</h4>
        {!!$classwork->description!!}
        <div class="row">
            <div class="col-md-8">


        <div>
            {!! $classroom->description !!}
        </div>
        <h4>comments</h4>

        <form action="{{route('comments.store')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$classwork->id}}">
            <input type="hidden" name="type" value="classwork">

            <div class="d-flex">
                <div class="col-8">

            <x-form.floating-control name="content">
                <x-slot:label>
                    <label for="content">Comment</label>
                </x-slot:label>
                <x-form.textarea name="content"  placeholder="description" />
            </x-form.floating-control>
            </div>

            <div class="ms-1">
            <button type="submit" class="btn btn-primary">Comment</button>

            </div>
        </div>



        </form>
        @foreach ($classwork->comments as $comment)

        <div class="card mb-3">
    <div class="card-body">

                <div class="row">
                    <div class="col-md-1">
                        <!-- Use the user's name to generate the avatar URL -->
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&rounded=true" alt="{{ $comment->user->name }}'s Avatar">
                    </div>
                    <div class="col-md-10">
                        <div class="col">
                        <p>{{$comment->user->name}}</p>
                        <p> {{$comment->created_at->diffForHumans(null, true)}}</p>

                        </div>
                        <div class="row">
                        <p>{{$comment->content}}</p>

                        </div>
                    </div>
                </div>

    </div>
</div>
@endforeach
        </div>
        <div class="col-md-4">
            @can('submissions.create',[$classwork])

            <div class="bordered rounded p-3 bg-light">
                <h4>Submit</h4>
                @if ($submissions->count())
                <ul>
                    @foreach ($submissions as $submission )
                        <li><a href="{{route('submissions.file',$submission->id)}}">File#{{$loop->iteration}}</a></li>
                    @endforeach
                </ul>

                @else


                <form method="post" action="{{ route('submissions.store',$classwork->id)}}" enctype="multipart/form-data"  >
                    @csrf

                    <x-form.floating-control name="files.0">
                <x-slot:label>
                    <label for="files">Upload Files</label>
                </x-slot:label>
                <x-form.input name="files[]" type="file" multiple   placeholder="Select Files" />
            </x-form.floating-control>
            <button class="btn btn-primary">Submit</button>

                </form>
                @endif
            </div>
            @endcan
        </div>
        </div>


    </div>
</x-main-layout>
