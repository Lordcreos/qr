@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")



    <div class="container-fluid">




        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-0">All Orders

                            <span class="badge badge-md badge-circle badge-floating badge-info border-white"> {{$orders_count}}</span>
                        </h3>
                    </div>

                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-basic">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Order Placed At</th>
                        <th>Table Number</th>
                        <th>Accept / Reject</th>
                        <th>View Order</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1 @endphp

                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $i++}}</td>

                            <td>{{ $order->order_unique_id }}</td>

                            <td>
                                {{$order->total}}
                            </td>

                            <td>
                                {{--                                        @php print_r($order->status) @endphp--}}
                                @if($order->status == 1)
                                    <span class="badge badge-info">Order Placed</span>
                                @endif

                                @if($order->status == 2)
                                    <span class="badge badge-warning">Processing</span>
                                @endif
                                @if($order->status == 5)
                                    <span class="badge badge-default">Ready</span>
                                @endif

                                @if($order->status == 3)
                                    <span class="badge badge-danger">Rejected</span>
                                @endif

                                @if($order->status == 4)
                                    <span class="badge badge-success">Order Completed</span>
                                @endif


                            </td>
                            <td>
                                {{$order->created_at->diffForHumans()}}
                            </td>
                            <td> <span class="badge badge-primary"> {{$order->table_no}}</span></td>
                            <td>
                                @if($order->status == 1)
                                    <a class="btn btn-primary btn-sm text-white"
                                       onclick="document.getElementById('accept_order{{$order->id}}').submit();">Accept
                                        Order</a>
                                    <a class="btn btn-danger btn-sm text-white"
                                       onclick="document.getElementById('reject_order{{$order->id}}').submit();">Reject
                                        Order</a>
                                @endif


{{--                                @if($order->status == 2)--}}
{{--                                    <a class="btn btn-outline-success btn-sm"--}}
{{--                                       onclick="document.getElementById('complete_order{{$order->id}}').submit();">Complete--}}
{{--                                        Order</a>--}}
{{--                                @endif--}}


                                    @if($order->status == 2)
                                        <a class="btn btn-outline-success btn-sm"
                                           onclick="document.getElementById('ready_to_serve{{$order->id}}').submit();">Ready to Serve</a>
                                    @endif
                                    @if($order->status == 5)
                                        <a class="btn btn-outline-success btn-sm"
                                           onclick="document.getElementById('complete_order{{$order->id}}').submit();">Complete</a>
                                    @endif


                                @if($order->status == 3)
                                    <a class="btn btn-danger btn-sm text-white">Rejected</a>
                                @endif

                                @if($order->status == 4)
                                    <a class="btn btn-success btn-sm text-white">Completed</a>
                                @endif


                                <form style="visibility: hidden" method="post"
                                      action="{{route('store_admin.update_order_status',['id'=>$order->id])}}"
                                      id="accept_order{{$order->id}}">
                                    @csrf
                                    @method('patch')
                                    <input style="visibility:hidden" name="status" type="hidden" value="2">
                                </form>
                                <form style="visibility: hidden" method="post"
                                      action="{{route('store_admin.update_order_status',['id'=>$order->id])}}"
                                      id="reject_order{{$order->id}}">
                                    @csrf
                                    @method('patch')
                                    <input style="visibility:hidden" name="status" type="hidden" value="3">
                                </form>
                                    <form style="visibility: hidden" method="post"
                                          action="{{route('store_admin.update_order_status',['id'=>$order->id])}}"
                                          id="ready_to_serve{{$order->id}}">
                                        @csrf
                                        @method('patch')
                                        <input style="visibility:hidden" name="status" type="hidden" value="5">
                                    </form>


                                <form style="visibility: hidden" method="post"
                                      action="{{route('store_admin.update_order_status',['id'=>$order->id])}}"
                                      id="complete_order{{$order->id}}">
                                    @csrf
                                    @method('patch')
                                    <input style="visibility:hidden" name="status" type="hidden" value="4">
                                </form>

                            </td>

                            <td style="text-align: center">
                                    <span>
                                    <a class="btn btn-default btn-sm"
                                       href="{{route('store_admin.view_order',$order->id)}}">
                                      View Order
                                    </a>
                                        </span>

                            </td>


                        </tr>




                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>




    </div>






@endsection
