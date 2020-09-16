@extends('base')
@section('content')
    <link rel="stylesheet" href="/assets/dist/switch.css">
    <script>
        function checked(item) {
            alert(item.checked);
        }
    </script>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">

                    <div class="card-header">
                        <h4 class="card-title">
                            <a href="{{route('panel.device.index')}}"><i class="fa fa-arrow-right"></i></a>    {{isset($panel_title)?$panel_title:""}}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @include('panel.notification')
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        نام
                                    </th>
                                    <th>
                                        وضعیت
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(count($devices)<1)
                                    <tr>
                                        <td colspan="5">هیچ کلیدی برای این دستگاه تعریف نشده است</td>
                                    </tr>
                                @else
                                    @foreach($devices as $item)

                                        <tr>
                                            <td>
                                                <a href="{{route('panel.device.sub-device',[$id,base64_encode($item->id)])}}"> {{$item->name}} </a>
                                            </td>
                                            <td>
                                                <input {{!$item->isDisable?"checked":""}}
                                                       onclick="return checked(this)" type="checkbox"
                                                       class="demo-size-{{$item->id}}" id="isEnabled" name="isEnabled"
                                                       value="1">

                                                {{--<a href="{{route('panel.device.part.toggle',[base64_encode($item->id),$item->isDisable?2:1])}}"><img--}}
                                                {{--width="32px"--}}

                                                {{--src="/assets/img/{{!$item->isDisable?"on":"off"}}.png"></a>--}}
                                            </td>


                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script src="/assets/dist/switch.js"></script>

                <script>
                        @foreach($devices as $item)
                        var flag{{$item->id}} ="{{$item->isDisable?2:1}}";
                    var mySwitch1 = new Switch(document.querySelector('.' + 'demo-size-{{$item->id}}'), {
                        size: 'small', onChange: function () {
                                var xhttp{{$item->id}} = new XMLHttpRequest();
                                xhttp{{$item->id}}.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        flag{{$item->id}} =mySwitch1.getChecked()?"1":"2";
                                        demo.showNotification('bottom','center',2,"با موفقیت ثبت شد");
                                    }else if (this.readyState == 4 && this.status != 200) {
                                        flag{{$item->id}} =mySwitch1.getChecked()?"1":"2";
                                        demo.showNotification('bottom','center',3,"خطا در ثبت");
                                        if(mySwitch1.getChecked())
                                            mySwitch1.on();
                                        else
                                            mySwitch1.off();
                                    }
                                };
                                xhttp{{$item->id}}.open("POST", "/api/devices/part/{{base64_encode($item->id)}}/toggle/"+flag{{$item->id}}+"/{{base64_encode(base64_encode(\Illuminate\Support\Facades\Auth::id()))}}", true);
                                xhttp{{$item->id}}.send();
                        }
                    });
                    @if(!$item->device->isEnabled)
                        mySwitch1.disable();
                        @endif
                    @endforeach

                </script>

        </div>
    </div>
@endsection
