@extends('layouts.master')
@section('title',$classroom->name)
@section('content')
    <div class="container">


    <div class="card text-bg-dark">
    <img src="{{$classroom->cover_image_url }}" class="card-img-top" alt="">
    <div class="card-img-overlay d-flex flex-column-reverse">
    <h3 class="p-2">{{$classroom->section}}</h3>

    <h1 class="p-2">{{ $classroom->name }} (#{{ $classroom->id }}</h1>
    </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-3">

            <div class="border rounded p-3 text-center">
                <span class="text-success fs-2">
                    {{$classroom->code}}
                </span>
            </div>
        </div>
        <div class="col-md-9">
            <p>Inviation link : <a href="{{$invation_link}}">{{$invation_link}}</a></p>
            <p><a href="{{route('classrooms.classworks.index',$classroom->id)}}" class="btn btn-outline-dark">Classworks</a></p>
        </div>
    </div>
    </div>
    @endsection
