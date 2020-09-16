<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>سامانه کاربری خانه هوشمند</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <link href="/assets/login/style.css?v=1.0.1" rel="stylesheet"/>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="login" dir="rtl">
    <img src="/assets/img/logo-vertical.png" align="center" style="width: 300px;">

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p style="text-align: right;">{{$error}}</p>
            @endforeach
        </div>
    @endif
    @if(session('err'))
        <div class="alert alert-danger">
            <p>{{session('err')}}</p>
        </div>
    @endif
    <form method="post">
        {{csrf_field()}}
        <input style="width: 100%;" type="text" name="username" value="{{old('username')}}" placeholder="نام کاربری" required="required"/>
        <input style="width: 100%;" type="password" name="password" placeholder="رمز عبور" required="required"/>
        <div class="form-group" style="display: flex;">
            <input name="remmber" type="checkbox"><label style="color: white;font-size: x-small;">مرا به خاطر بسپار</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-large">ورود</button>
    </form>
</div>
<!-- partial -->
<script src="/assets/login/script.js"></script>

</body>
</html>
