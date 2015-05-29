@if (Session::has('flash_message') && Session::has('flash_message_type'))
    <div class="alert {{ session('flash_message_type') }}" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('flash_message') }}
    </div>
@endif