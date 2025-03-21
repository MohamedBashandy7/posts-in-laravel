@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('delete'))
    <div class="alert alert-danger">
        {{ session('delete') }}
    </div>
@endif
