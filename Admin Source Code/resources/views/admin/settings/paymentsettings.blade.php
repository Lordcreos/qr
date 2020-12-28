
@extends("admin.adminlayout")

@section("admin_content")

    <div class="container-fluid mt--6">

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="left-side-tabs">
                    <div class="dashboard-left-links">
                        <a href="{{route('settings')}}" class="user-item">Site Settings</a>
                        <a href="{{route('account_settings')}}" class="user-item ">Account Settings</a>
                        <a href="#" class="user-item active"> Payment Settings</a>
                        <a href="{{route('whatsapp')}}" class="user-item"> Whatsapp Notification Settings</a>
                        <a href="{{route('privacy_policy')}}" class="user-item">  Privacy Policy</a>
                        <a href="{{route('cache_settings')}}" class="user-item">  Cache Settings</a>

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="card card-static-2 mb-30">
                    <div class="card-title-2">
                        <h4>Payment Settings</h4>
                    </div>
                    <div class="card-body">
                        @if(session()->has("MSG"))
                            <div class="alert alert-{{session()->get("TYPE")}}">
                                <strong> <a>{{session()->get("MSG")}}</a></strong>
                            </div>
                        @endif
                        @if($errors->any()) @include('admin.admin_layout.form_error') @endif

                        <form class="form-horizontal" method="post" action="{{route('update_payment_settings')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

                          <table class="table align-items-left table-flush table-hover">

                              <tbody>
                              <tr>
                                  <td class="table-user">
                                      <b>Cash</b>
                                  </td>

                                  <td>
                                      <label class="custom-toggle">
                                          <input type="checkbox" checked="" disabled>
                                          <span class="custom-toggle-slider rounded-circle" data-label-off="Off" data-label-on="On"></span>
                                      </label>
                                  </td>
                              </tr>

                              <tr>
                                  <td class="table-user">
                                      <b>Stripe</b>
                                  </td>
                                  <td>
                                      <label class="custom-toggle">
                                          <input type="checkbox" name="{{$settings[0]->id}}" {{$settings[0]->value ==1 ? "checked":NULL}} >
                                          <span class="custom-toggle-slider rounded-circle" data-label-off="Off" data-label-on="On"></span>
                                      </label>
                                  </td>
                              </tr>
                              </tbody>
                          </table>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Currency:</label>
                                        <input type="text"  value="{{$settings[1]->value}}" name="{{$settings[1]->id}}"  class="form-control" placeholder="Stripe Public Key">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Stripe Public Key:</label>
                                        <input type="text"  value="{{$settings[2]->value}}" name="{{$settings[2]->id}}" class="form-control" placeholder="Stripe Public Key">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Stripe Secret Key:</label>
                                        <input type="text" value="{{$settings[3]->value}}" name="{{$settings[3]->id}}"  class="form-control" placeholder="Stripe Secret Key">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default btn-flat m-b-30 m-l-5 bg-primary border-none m-r-5 -btn">Save Settings</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
