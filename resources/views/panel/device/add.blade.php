@extends('base')
@section('content')
    <link rel="stylesheet" href="/assets/dist/switch.css">

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{isset($panel_title)?$panel_title:""}}</h5>
                    </div>
                    <div class="card-body" style="margin-right: 20px;">
                        @include('panel.notification')
                        <form method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-2 pr-md-1">
                                    <div class="form-group">
                                        <label for="isEnabled">وضعیت دستگاه</label>
                                        <input type="checkbox" class="demo-size-2" id="isEnabled" name="isEnabled"
                                               {{isset($device)&&$device->isEnabled?"checked":old('isEnabled')}}
                                               value="1">
                                    </div>
                                </div>
                                <div class="col-md-2 pr-md-1">
                                    <div class="form-group">
                                        <label for="isReadLocation">وضعیت GPS</label>
                                        <input type="checkbox" id="isReadLocation" name="isReadLocation"
                                               {{isset($device)&&$device->isReadLocation?"checked":old('isReadLocation')}}
                                               value="1" class="demo-size-1" >
                                    </div>
                                </div>

                            </div>

                            <div class="row" style="margin-top: 20px;">

                                <div class="col-md-6 px-md-1">
                                    <div class="form-group">
                                        <label for="name">نام دستگاه<span style="color: red;">*</span></label>
                                        <input type="text" name="name"  class="form-control"
                                               value="{{isset($device)?$device->name:old('name')}}">
                                    </div>
                                </div>
                                <div class="col-md-5 pl-md-1">
                                    <div class="form-group">
                                        <label for="serial">سریال دستگاه<span style="color: red;">*</span></label>
                                        <input  type="text" class="form-control" name="serial"
                                                value="{{isset($device)?$device->serial:old('serial')}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-6 pl-md-1">
                                    <div class="form-group">
                                        <label for="wifi_name">نام Wi-Fi
                                        <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" name="wifi_name" id="wifi_name"
                                               value="{{isset($device)?$device->wifi_name:old('wifi_name')}}"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-5 pl-md-1">
                                    <div class="form-group">
                                        <label for="wifi_password">رمز Wi-Fi
                                            <span style="color: red;">*</span></label>
                                        <input type="text" name="wifi_password" id="wifi_password"
                                               value="{{isset($device)?$device->wifi_password:old('wifi_password')}}"
                                               class="form-control" >
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <br>
                                <span style="color: red;font-size: small;margin-right: -20px">فیلد های ستاره(*) دار الزامی است</span>
                                <br>
                                <button style="margin-top: 20px;" type="submit" class="btn btn-fill btn-primary">ذخیره</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="/assets/dist/switch.js"></script>
    <script>
        var switches = {};
        var switchConfig = {
            'demo-size-1': {
                size: 'small'
            },
            'demo-size-2': {
                size: 'small'
            },
            'demo-checked-1': {
                checked: false
            },
            'demo-color-1': {
                onSwitchColor    : '#34B363',
                offSwitchColor   : '#D6B3A3',
                onJackColor      : '#1453B3',
                offJackColor     : '#A4B363'
            },

        };

        Object.keys(switchConfig).forEach(function (key) {
            switches[key] = new Switch(document.querySelector('.' + key),switchConfig[key]);
        });

        hljs.initHighlightingOnLoad();

    </script>
@endsection
