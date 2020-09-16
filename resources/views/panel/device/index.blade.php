@extends('base')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{isset($panel_title)?$panel_title:""}}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @include('panel.notification')
                            {{--<a class="btn btn-success" href="{{route('panel.device.create')}}">ایجاد دستگاه جدید</a>--}}
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        نام دستگاه
                                    </th>
                                    <th>
                                        شماره سریال
                                    </th>
                                    <th>
                                        وضعیت
                                    </th>
                                    <th>
                                        وضعیت GPS
                                    </th>
                                    <th>
                                        عملیات
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
                                                <a href="{{route('panel.device.part',base64_encode($item->id))}}">{{$item->name}}</a>
                                            </td>
                                            <td>
                                                {{$item->serial}}
                                            </td>
                                            <td>
                                                {{$item->isEnabled?"فعال":"غیرفعال"}}
                                            </td>
                                            <td>
                                                {{$item->isReadLocation?"فعال":"غیرفعال"}}
                                            </td>
                                            <td>
                                                {{--<a href="{{route('panel.device.delete',base64_encode($item->id))}}"><i--}}
                                                        {{--class="fa fa-trash"></i></a>--}}
                                                <a href="{{route('panel.device.edit',base64_encode($item->id))}}"><i
                                                        class="fa fa-edit"></i></a>
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

        </div>
    </div>
@endsection
