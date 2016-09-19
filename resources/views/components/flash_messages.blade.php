@if (Session::has('message'))
    <div class="alert alert-info" role="alert">{{ Session::get('message') }}</div>
@endif