@extends('base')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{isset($panel_title)?$panel_title:""}}</h5>
                    </div>
                    <div class="card-body">
                        @include('panel.notification')
                        <form method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-5 pr-md-1">
                                    <div class="form-group">
                                        <label>نام کاربری</label>
                                        <input type="text" class="form-control" disabled placeholder="نام کاربری"
                                               value="{{$user->username}}">
                                    </div>
                                </div>
                                <div class="col-md-3 px-md-1">
                                    <div class="form-group">
                                        <label>نام و نام خانوادگی</label>
                                        <input type="text" name="full_name" class="form-control" placeholder="Username"
                                               value="{{$user->full_name}}">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ایمیل</label>
                                        <input disabled type="email" class="form-control"
                                               placeholder="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group">
                                        <label>رمز عبور</label>
                                        <input type="password" name="pass" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-md-1">
                                    <div class="form-group">
                                        <label>تکرار رمز عبور</label>
                                        <input type="password" name="pass-repeat" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6 pl-md-1">
                                    <div class="form-group">
                                        <label>آواتار</label>
                                        <input type="file" name="avatar" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary">ذخیره</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-body">
                        <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="javascript:void(0)">
                                <img class="avatar"
                                     src="{{$user->avatar_url!=null?$user->avatar_url:"/assets/img/avatar.png"}}"
                                     alt="...">
                                <h5 style="text-align: center">نام و نام خانوادگی:{{$user->full_name}}</h5>
                                <h5 style="text-align: center">نام کاربری:{{$user->username}}</h5>
                                <h5 style="text-align: center">ایمیل:{{$user->email}}</h5>
                                <h5 style="text-align: center">تاریخ ایجاد حساب:{{$user->getDate()}}</h5>

                            </a>

                        </div>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
