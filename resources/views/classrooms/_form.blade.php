<x-form.floating-control name="name">
    <x-slot:label>
        <label for="name">Classroom Name</label>
    </x-slot:label>
    <x-form.input name="name" :value="$classroom->name" placeholder="Class Name" />
</x-form.floating-control>
<x-form.floating-control name="section">
    <x-slot:label>
        <label for="section">Section</label>
    </x-slot:label>
    <x-form.input name="section" value="{{$classroom->section}}" placeholder="Section" />
</x-form.floating-control>
    <x-form.floating-control name="subject" placeholder="Subject">
    <x-slot:label>
        <label for="subject">Subject</label>
    </x-slot:label>
    <x-form.input name="subject" value="{{$classroom->subject}}" placeholder="Subject" />
    </x-form.floating-control>

    <x-form.floating-control name="room" placeholder="Room">
    <x-slot:label>
        <label for="room">Room</label>
    </x-slot:label>
    <x-form.input name="room" value="{{$classroom->room}}" placeholder="room" />
    </x-form.floating-control>


    <x-form.floating-control name="cover_image" placeholder="Cover Image">
        @if ($classroom->cover_image_path)
        {{--<img src="{{Storage::disk('public')->url($classroom->cover_image_path)}}">--}}
        <img src="{{asset('storage/' .$classroom->cover_image_path)}}">

        {{--<img src="{{ storage::disk('public')->url($classroom->cover_image_path) }}">--}}
        @endif
        <x-slot:label>
        <label for="cover_image">Cover image</label>
    </x-slot:label>
        <x-form.input type="file" name="cover_image" value="{{$classroom->cover_image_path}}" placeholder="Cover Image" />

    </x-form.floating-control>

    <button type="submit" class="btn btn-primary">{{$button_label}}</button>
