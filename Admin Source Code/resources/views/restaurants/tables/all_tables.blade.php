@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")
    <div class="container-fluid">


        <div class="card-body">
            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-6 text-right">
                    <button onclick="event.preventDefault(); document.getElementById('add_new').submit();"
                            class="btn btn-md btn-primary btn-round btn-icon" data-toggle="tooltip"
                            data-original-title="Add Tables">
                        <span class="btn-inner--icon"><i class="fas fa-chair"></i></span>
                        <span class="btn-inner--text">Add Tables</span>
                    </button>

                    <button onclick="event.preventDefault(); document.getElementById('table_report').submit();"
                            class="btn btn-md btn-warning btn-round btn-icon" data-toggle="tooltip"
                            data-original-title="Table Report">
                        <span class="btn-inner--icon"><i class="fas fa-receipt"></i></span>
                        <span class="btn-inner--text">Table Report</span>
                    </button>

                    <form action="{{route('store_admin.add_tables')}}" method="get" id="add_new"></form>
                    <form action="{{route('store_admin.table_report')}}" method="get" id="table_report"></form>
                </div>

            </div>
        </div>






        <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">


                @php $i=1 @endphp
                @foreach($tables as $data)

                    <div class="col-md-3">

                        <div class="card">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">

                                        <h3 style="padding: 5px;">
                                            Table No: <b>{{ $data->table_name }}</b>
                                        </h3>


                                    </div>

                                    <div class="col-auto">

                                        <label class="custom-toggle">
                                            <input type="checkbox" disabled {{$data->is_active ==1?"checked":NULL}}>
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="Off" data-label-on="On"></span>
                                        </label>


                                    </div>

                                </div>


                                <hr>
                                <div class="row" style="margin-top: -18px;">
                                    <div class="col">
                                        <a href="{{route('store_admin.edit_table',$data->id)}}"><b>Edit</b></a>

                                    </div>
                                    <div class="col">
                                        <a href="{{route('download_tblqr',[Auth::user()->view_id,$data->table_name])}}"><b style="color: red;">QR Code</b></a>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>




@endsection
