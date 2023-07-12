@include('partiels.header')

<div class="container">
    <h1>Topics</h1>
    <div class="row">

        <div class="col-md-3">
            <h6>All topics</h6>
            <div class="col-md-3">
                <p>{{$topic->name}}</p>

            </div>


        </div>

        <div class="col p-3">
            <div class="col-md-9">


                <h5 class="card-title">{{$topic->name}}</h5>
                <hr>

            </div>


        </div>
    </div>

</div>

@include('partiels.footer')
