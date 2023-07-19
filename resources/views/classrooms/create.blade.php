@extends('layouts.master')
@section('title','Create Classrooms')
@section('content')

    <div class="container">
    <h1>Create Classroom</h1>
<x-showall-errors />

<form action="{{route('classrooms.store')}}" method="post" enctype="multipart/form-data">
   
    @csrf
 @include('classrooms._form',[
    'button_label' =>'Create Classroom'])
</form>
</div>
@endsection
