<x-admin-master>

@section('content')
<div class="mx-4">
    <div class="row">
            <br>
        <h1><i class="fa fa-envelope"></i> My Messages</h1><br>
<div class="container">
    <div class="col-12">
        <br>
            @if(count($my_messages)>0)
            @foreach($my_messages as $mm)
                <div class="card">
                    <div class="card-header"><h2>Message from: {{$mm->name}}</h2></div>
                    <div class="card-body mymessage">
                        <h4>{{$mm->message}}
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{route('reply.message')}}" method="post">
                        @csrf
                        <input type="hidden" name="original_message" value="{{$mm->message}}">
                        <input type="hidden" name="rid" value="{{$mm->user_id}}">
                        <input type="hidden" name="email" value="{{$mm->email}}">
                        <button type="submit" class="btn btn-info btn-sm" title="Reply to sender"> 
                            Reply 
                        </button>
                </div>
            @endforeach
            @else 
                @if(strlen($error_message)>0)
                    <h3>{{$error_message}}</h3>
                @endif
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
</x-admin-master>