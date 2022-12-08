
@if (session()->has('danger'))
    <div class="alert alert-danger">
        {{session()->get('danger')}}
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif

@if (session()->has('info'))
    <div class="alert alert-info">
        {{session()->get('info')}}
    </div>
@endif