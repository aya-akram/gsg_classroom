<x-main-layout title="Classrooms" class="">
<div class="container">
    <h1>{{__('Classrooms')}}</h1>
<x-alert name="success" class="alert-success" />
<x-alert name="error" id="error" class="aler-danger" />

<ul id="classrooms"></ul>

    <div class="row">
        @foreach ($classrooms as $classroom )
        <div class="col-md-3">
        <x-class-card :classroom="$classroom"></x-class-card>
        </div>

        @endforeach
    </div>

</div>

@push('scripts')
<script>
    fetch('/api/v1/classrooms')
        .then(res => res.json())
        .then(json => {
            let ul = document.getElementById('classrooms');
            for(let i in json.data){
                ul.innerHTML += `<li>${json.data[i].name}</li>`
            }

        })
</script>

@endpush
</x-main-layout>
