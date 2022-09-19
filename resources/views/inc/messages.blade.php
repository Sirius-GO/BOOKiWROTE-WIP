@if(count($errors) > 0)
        <div class="alert alert-danger alert-dismissable message_bar">
            @foreach($errors->all() as $error)
             <div>{{$error}}</div>
            @endforeach
        </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissable message_bar">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissable message_bar">
        {{session('error')}}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissable message_bar">
        {{session('info')}}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissable message_bar">
        {{session('warning')}}
    </div>
@endif

@if(session('csrf'))
    <div class="text-xs">
        {{session('csrf')}}
    </div>
@endif