<div id='alert-box' class="alert alert-danger"
    
    {!! $errors->any() ? '' : "style='display: none'" !!}
    >
    <b>Ops...</b>
    <ul>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
    </ul>
</div>

@if (Session::has('flash_message'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('flash_message') }}
    </div>
@endif