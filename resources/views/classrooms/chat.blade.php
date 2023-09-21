@extends('layouts.master')

@section('title', $classroom->name)

@section('content')

<div class="container">
    <div class="card text-bg-dark">
        <img src="{{$classroom->cover_image_url }}" class="card-img-top" alt="">
        <div class="card-img-overlay d-flex flex-column-reverse">

            <h1 class="p-2">{{ $classroom->name }} - Chat Room </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="border rounded p-3 text-center">

            </div>
        </div>
        <div class="col-md-9">
            <div id="messages" class="border rounded bg-light p-3 mb-3">

            </div>
            <form class="row g-3 align-items-center" id="message-form">
                <div class="col-9">
                    <label class="visually-hidden" for="body">Username</label>
                    <div class="input-group">
                        <div class="input-group-text"></div>
                        <textarea class="form-control" name="body" id="body" placeholder="Type your message.."></textarea>
                    </div>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    (function($) {
        function getMessages(page =1){
        $.ajax({
            method:"get",
            url:"{{route('classrooms.messages.index',[$classroom->id])}}",
            headers:{
                "x-api-key" : "OFKJKJGHGJKFJKFGJFGKKUDUFHUSKKBsddd44"
            },
            success:function(response){
              for(let i in  response.data) {
                let message = response.data[i];
                $('#messages').prepend(`<div class="bg-info rounded p-2 mt-2">
                <div>
                <b>${message.sender.name}</b>
                -<span class ="text-muted">${message.sent_at}</span>
                </div>
                <div>${message.body}</div>
                </div>`);
              }
            }
        })


    }

    function send(message) {
            $.post("route('classrooms.messages.store',[$classroom->id])"),
            {
                _token: "{{csrf_token()}}",
                body: message
            },
            function(){
                location.reload();
            }
        };


        $("message-form").on('submit',function(e){
        e.preventDefault();
        send($(this).find('textarea').val());
    })
    $(document).ready(function(){
        getMessages()
    })

    }


    )(jQuery);

</script>

@endpush
