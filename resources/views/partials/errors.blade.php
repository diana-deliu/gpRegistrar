@if (count($errors) > 0)
    <div class="alert alert-danger">
        Au intervenit probleme în procesarea cererii:<br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif