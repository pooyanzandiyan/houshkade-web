@extends('base')
@section('content')
    <link rel="stylesheet" href="/assets/dist/switch.css">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a href="{{route('panel.device.part',$id)}}"><i
                                    class="fa fa-arrow-right"></i></a> {{isset($panel_title)?$panel_title:""}}
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
                                                {{$item->name}}
                                            </td>
                                            <td>
                                                <input {{$item->isOn?"checked":""}}
                                                       onclick="return checked(this)" type="checkbox"
                                                       class="demo-size-{{$item->id}}" id="isEnabled" name="isEnabled"
                                                       value="1">
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
                var flag{{$item->id}} = "{{$item->isOn?2:1}}";
                var url{{$item->id}} = "/api/devices/part/sub-device/{{base64_encode($item->id)}}/toggle/" + flag{{$item->id}}+ "/{{base64_encode(base64_encode(\Illuminate\Support\Facades\Auth::id()))}}";

                var mySwitch1 = new Switch(document.querySelector('.' + 'demo-size-{{$item->id}}'), {
                    size: 'small', onChange: function () {
                        var xhttp{{$item->id}} = new XMLHttpRequest();
                        xhttp{{$item->id}}.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                flag{{$item->id}} = flag{{$item->id}}=="2" ? "1" : "2";
                                //alert(flag{{$item->id}});
                                demo.showNotification('bottom', 'center', 2, "با موفقیت ثبت شد");
                            }
                        };
                        url{{$item->id}} = "/api/devices/part/sub-device/{{base64_encode($item->id)}}/toggle/" + flag{{$item->id}}+ "/{{base64_encode(base64_encode(\Illuminate\Support\Facades\Auth::id()))}}";
                        xhttp{{$item->id}}.open("POST", url{{$item->id}}, true);
                        xhttp{{$item->id}}.send();
                    }
                });
                @if($item->part->isDisable||!$item->part->device->isEnabled)
                mySwitch1.disable();
                @endif
                @endforeach

            </script>
        </div>
    </div>
@endsection
