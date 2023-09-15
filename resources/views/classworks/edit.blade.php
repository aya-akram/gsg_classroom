<x-main-layout :title="$classroom->name">
    <div class="container">

        <h1>{{$classroom->name}} (#{{$classroom->id}}</h1>
        <h3>Update Classworks</h3>
        <x-alert name="success" class="alert-success" />

        <hr>
        <form action="{{route('classrooms.classworks.update',[$classroom->id,$classwork->id,'type' =>$type])}}" method="post">
            @csrf
            @method('put')

            @include('classworks._form')

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
</x-main-layout>
