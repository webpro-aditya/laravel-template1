@if (session('error'))
<div class="alert alert-danger alert-dismissible" id="alert-danger" role="alert">
    <span class="alert-text">
        {{ session('error') }}
    </span>
    <button type="button" class="close btn btn-flat" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible" id="alert-success" role="alert">
        <span class="alert-text">
            {{ session('success') }}
        </span>
        <button type="button" class="close btn btn-flat" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

{{--
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
--}}