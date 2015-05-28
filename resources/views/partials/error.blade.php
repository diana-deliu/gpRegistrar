@if (Session::has('flash_message') && Session::has('flash_message_type'))
    <div class="alert {{ session('flash_message_type') }}" role="alert">
        <button class="close">x</button>
        {{ session('flash_message') }}
    </div>
@endif