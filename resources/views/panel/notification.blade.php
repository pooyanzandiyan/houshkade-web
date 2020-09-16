@if(session('msg'))
    <div class="alert alert-success">
        <p>{{session('msg')}}</p>
    </div>
@endif
@if(session('err'))
    <div class="alert alert-danger">
        <p>{{session('err')}}</p>
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif
