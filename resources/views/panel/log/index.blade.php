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
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
                                <tr>

                                    <th>
                                        توضیحات
                                    </th>
                                    <th>
                                        تاریخ
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(count($logs)<1)
                                    <tr>
                                        <td colspan="5">هیچ کلیدی برای این دستگاه تعریف نشده است</td>
                                    </tr>
                                @else
                                    @foreach($logs as $item)

                                        <tr>

                                            <td>
                                                {{$item->description}}
                                            </td>
                                            <td>
                                                {{$item->getDate()}}
                                            </td>



                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                           {{$logs->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
