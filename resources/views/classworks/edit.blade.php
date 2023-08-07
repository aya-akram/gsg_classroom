<x-main-layout :title="$classroom->name">
    <div class="container">

        <h1>{{$classroom->name}} (#{{$classroom->id}}</h1>
        <h3>Update Classworks</h3>
        <x-alert name="success" class="alert-success" />

        <hr>
        <form action="{{route('classrooms.classworks.update',[$classroom->id,$classwork->id,'type' =>$type])}}" method="post">
            @csrf
            @method('put')
        <div class="row">
            <div class="col-md-8">
            <x-form.floating-control name="title">
                <x-slot:label>
                    <label for="title">Title</label>
                </x-slot:label>
                <x-form.input name="title" :value="$classwork->title" placeholder="Title" />
            </x-form.floating-control>

            <x-form.floating-control name="description">
                <x-slot:label>
                    <label for="description">Descrption (optional)</label>
                </x-slot:label>
                <x-form.textarea name="description" :value="$classwork->description" placeholder="description" />
            </x-form.floating-control>
            </div>
            <div class="col-md-4">
                <div>
                    @foreach ($classroom->students as $student)
                    <div class="form-check">
                        <input class="form-check-input" name="students[]" type="checkbox" value="{{ $student->id }}" id="std-{{$student->id}}" @checked(in_array($student->id,$assigned))>
                        <label class="form-check-label" for="std-{{$student->id}}">
                          {{$student->name}}
                        </label>
                    </div>
                    @endforeach
                </div>

            <x-form.floating-control name="topic_id">
                <x-slot:label>
                <label for="topic_id">Topic (optional)</label>
                </x-slot:label>
                <select class="form-select" name="topic_id" id="topic_id">
                        <option value="">No Topic</option>
                        @foreach ($classroom->topics as $topic )
                        <option @selected($topic->id == $classwork->topic_id) value="{{$topic->id}}">{{$topic->name}}</option>
                        @endforeach

                    </select>
                    <x-show-error name="topic_id" />

            </x-form.floating-control>
            </div>
        </div>


            <button type="submit" class="btn btn-primary">Create</button>
        </form>

    </div>
</x-main-layout>
