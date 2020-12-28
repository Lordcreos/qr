@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")


    <div class="container-fluid">
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Edit Category</h3>
                @if(session()->has("MSG"))
                    <div class="alert alert-{{session()->get("TYPE")}}">
                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                    </div>
                @endif
                @if($errors->any()) @include('admin.admin_layout.form_error') @endif
            </div>
            <!-- Card body -->
            <div class="card-body">
                <form method="post" action="{{route('store_admin.edit_category',['id'=>$data->id])}}" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PATCH')
                <!-- Form groups used in grid -->
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols1Input">Image</label>




                                <div class="custom-file">
                                    <input name="image_url"  class="file-name input-flat ui-autocomplete-input" type="file" readonly="readonly" placeholder="Browses photo" autocomplete="off">


                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Category Name</label>
                                <input type="text"  name="name" value="{{$data->name}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="exampleFormControlSelect1">Is Enabled</label>
                                <select class="form-control" name="is_active" required>
                                    <option value="1" {{$data->is_active == 1 ? "selected":NULL}}>Enabled</option>
                                    <option value="0" {{$data->is_active == 0 ? "selected":NULL}}>Disabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>


                    </div>

                </form>
            </div>



        </div>




{{--        --}}

{{--        <div class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <div class="card alert">--}}
{{--                <div class="card-header">--}}
{{--                    <h4>Edit Category</h4>--}}
{{--                    @if(session()->has("MSG"))--}}
{{--                        <div class="alert alert-{{session()->get("TYPE")}}">--}}
{{--                            <strong> <a>{{session()->get("MSG")}}</a></strong>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @if($errors->any()) @include('admin.admin_layout.form_error') @endif--}}

{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="menu-upload-form">--}}
{{--                        <form class="form-horizontal" method="post" action="{{route('store_admin.edit_category',['id'=>$data->id])}}" enctype="multipart/form-data">--}}
{{--                            {{csrf_field()}}--}}
{{--                            @method('PATCH')--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="col-sm-2 control-label">Photo</label>--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <div class="form-control file-input dark-browse-input-box">--}}

{{--                                        <input name="image_url"  class="file-name input-flat ui-autocomplete-input" type="file" readonly="readonly" placeholder="Browses photo" autocomplete="off">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="col-sm-2 control-label">Category Name</label>--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <input type="text" name="name" value="{{$data->name}}" class="form-control" placeholder="Category Name">--}}
{{--                                </div>--}}
{{--                            </div>--}}



{{--                            <div class="form-group">--}}
{{--                                <label class="col-sm-2 control-label">Is Enabled</label>--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <select class="form-control" name="is_active" required>--}}
{{--                                        <option value="1" {{$data->is_active == 1 ? "selected":NULL}}>Enabled</option>--}}
{{--                                        <option value="0" {{$data->is_active == 0 ? "selected":NULL}}>Disabled</option>--}}


{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <div class="form-group">--}}
{{--                                <div class="col-sm-offset-2 col-sm-10">--}}
{{--                                    <button type="submit" class="btn btn-lg btn-primary">Upload</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /# card -->--}}
{{--        </div>--}}
{{--        <!-- /# column -->--}}
{{--    </div>--}}


@endsection
