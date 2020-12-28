
@extends("admin.adminlayout")

@section("admin_content")

    <div class="container-fluid mt--6">

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="left-side-tabs">
                    <div class="dashboard-left-links">
                        <a href="#" class="user-item active">Site Settings</a>
                        <a href="{{route('account_settings')}}" class="user-item ">Account Settings</a>
                        <a href="{{route('paymentsettings')}}" class="user-item">  Payment Settings</a>
                        <a href="{{route('whatsapp')}}" class="user-item"> Whatsapp Notification Settings</a>
                        <a href="{{route('privacy_policy')}}" class="user-item">  Privacy Policy</a>
                        <a href="{{route('cache_settings')}}" class="user-item">  Cache Settings</a>

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="card card-static-2 mb-30">
                    <div class="card-title-2">
                        <h4>Site Setting</h4>
                    </div>
                    <div class="card-body">
                        @if(session()->has("MSG"))
                            <div class="alert alert-{{session()->get("TYPE")}}">
                                <strong> <a>{{session()->get("MSG")}}</a></strong>
                            </div>
                        @endif
                        @if($errors->any()) @include('admin.admin_layout.form_error') @endif


                        <form class="form-horizontal" method="post" action="{{route('update_settings')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Application Name</label>
                                            <input type="text" value="{{$account_info !=NULL?$account_info->application_name:NULL}}" name="application_name" class="form-control" placeholder="Application Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email" value="{{$account_info !=NULL?$account_info->application_email:NULL}}" name="application_email" class="form-control" placeholder="Email address" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name"> Currency symbol</label>
                                            <input type="text"  class="form-control" placeholder="Currency symbol(default : ₹)" value="{{$account_info !=NULL?$account_info->currency_symbol:NULL}}" name="currency_symbol" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Contact No</label>
                                            <input type="number" name="contact_no" value="{{$account_info !=NULL? $account_info->contact_no:NULL}}" class="form-control" placeholder="Contact No" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Logo</label>
                                            <input type="file" name="application_logo"  class="form-control ui-autocomplete-input" placeholder="Application Logo ()" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                            </div>






                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Address</label>
                                    <textarea rows="4" name="address" class="form-control" >{{$account_info !=NULL?$account_info->Address:NULL}}</textarea>
                                </div>
                            </div>









                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default btn-flat m-b-30 m-l-5 bg-primary border-none m-r-5 -btn">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
