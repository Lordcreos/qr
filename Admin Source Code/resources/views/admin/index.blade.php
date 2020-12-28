@extends("admin.adminlayout")

@section("admin_content")


    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-gradient-primary border-0">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">{{ __('chef.stores') }}</h5>
                                <span class="h2 font-weight-bold mb-0 text-white">{{$store_count}}</span>
                                <div class="progress progress-xs mt-3 mb-0">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="30"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                                </div>
                            </div>

                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <a href="#!" class="text-nowrap text-white font-weight-600">See details</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-gradient-info border-0">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">{{ __('chef.products') }}</h5>
                                <span class="h2 font-weight-bold mb-0 text-white">{{$product_count}}</span>
                                <div class="progress progress-xs mt-3 mb-0">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                                </div>
                            </div>

                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <a href="#!" class="text-nowrap text-white font-weight-600">See details</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-gradient-danger border-0">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">{{ __('chef.earnings') }}</h5>
                                <span class="h2 font-weight-bold mb-0 text-white">{{$account_info != NULL ?$account_info->currency_symbol:"₹"}} {{$earnings}}</span>
                                <div class="progress progress-xs mt-3 mb-0">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                </div>
                            </div>

                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <a href="#!" class="text-nowrap text-white font-weight-600">See details</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-gradient-default border-0">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">{{ __('chef.pendingstores') }}</h5>
                                <span class="h2 font-weight-bold mb-0 text-white">{{$pending_stores }}</span>
                                <div class="progress progress-xs mt-3 mb-0">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="90"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                </div>
                            </div>

                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <a href="#!" class="text-nowrap text-white font-weight-600">See details</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ __('chef.newregistrations') }}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{route('all_stores')}}" class="btn btn-sm btn-primary">{{ __('chef.seeallstores') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center text-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('chef.storename') }}</th>
                                <th scope="col">{{ __('chef.storeemail') }}</th>
                                <th scope="col">{{ __('chef.phoneno') }}</th>
                                <th scope="col">{{ __('chef.subscriptionenddate') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($new_stores as $data)
                            <tr>
                                <th scope="row">
                                    {{$data->store_name}}
                                </th>
                                <td>
                                    {{$data->email}}
                                </td>
                                <td>
                                    {{$data->phone}}
                                </td>
                                <td>
                                    <span class="badge badge-default"> {{date('d-m-Y',strtotime($data->subscription_end_date))}}</span>
                                </td>

                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Expired Stores</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{route('all_stores')}}" class="btn btn-sm btn-primary">{{ __('chef.seeallstores') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('chef.storename') }}</th>
                                <th scope="col">{{ __('chef.subscriptionenddate') }}</th>
                                <th scope="col">{{ __('chef.phoneno') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expired_stores  as $data)
                            <tr>
                                <th scope="row">
                                   {{$data->store_name}}
                                </th>
                                <td>
                                    {{date('d-m-Y',strtotime($data->subscription_end_date))}}
                                </td>
                                <td>
                                    {{$data->phone}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
