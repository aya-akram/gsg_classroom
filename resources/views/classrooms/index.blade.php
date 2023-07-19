<x-main-layout title="Classrooms" class="">
<div class="container">
    <h1>Classrooms</h1>
<x-alert name="success" />

    <div class="row">
        @foreach ($classrooms as $classroom )
        <div class="col-md-3">
        <x-class-card :classroom="$classroom"></x-class-card>
        </div>

        @endforeach
    </div>

</div>

@push('scripts')
<script>console.log('@@stack')</script>

@endpush
</x-main-layout>
