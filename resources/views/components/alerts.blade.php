@if(session()->has('alert.success'))

    <div class="alert alert-success">
        {{ session()->get('alert.success') }}
    </div>
@endif
