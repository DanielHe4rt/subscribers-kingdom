@if(session()->has('alert.success'))

    <div class="alert alert-success">
        {{ session()->get('alert.success') }}
    </div>
@endif


@if(session()->has('alert.danger'))

    <div class="alert alert-danger">
        {{ session()->get('alert.danger') }}
    </div>
@endif
