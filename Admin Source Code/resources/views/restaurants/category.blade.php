@extends("restaurants.layouts.restaurantslayout")

@section("restaurantcontant")

    <style>


        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            right:40px;
            background-color:#322A7D;
            color:#FFA101;
            border-radius:50px;
            text-align:center;
            box-shadow: 2px 2px 3px #999;
        }


        .my-float{
            margin-top:22px;
        }
    </style>




    <div class="container-fluid">

<div class="card-body">
    <button class="btn" style="background-color: #FFA101; opacity: 65%; color: #000000">Category</button>
            <a class="btn btn-secondary" href="{{route('store_admin.products')}}">Products</a>

    <a href="{{route('store_admin.addon_categories')}}" class="btn btn-secondary">Addon Categories</a>
    <a href="{{route('store_admin.addon')}}" class="btn btn-secondary">Addons</a>





</div>

        <div class="alert alert-warning alert-dismissible fade show" style="margin-bottom: 15px;" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Delete Alert!</strong> Careful to delete category. auto delete all products in that category.</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="row">


            @php $i=1 @endphp
            @foreach($category as $cat)

                <div class="col-md-3">

                    <div class="card">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <img
                                        src="{{asset($cat->image_url !=NULL ? $cat->image_url:'themes/default/images/all-img/empety.png')}}"
                                        width="121" height="121" style="border-radius: 15px">
                                </div>

                                <div class="col-auto text-right">

                                    Status  &nbsp;  <span class="badge badge-{{$cat->is_active == 1 ? "success":"danger"}}">{{$cat->is_active == 1 ? "ENABLED":"DISABLED"}}</span>

                                </div>


                            </div>


                            <div class="row">
                                <div class="col">

                                    <h3 style="padding: 5px;">
                                        Name: <b>{{ $cat->name }}</b>
                                    </h3>


                                </div>

                            </div>
                            <hr>
                            <div class="row" style="margin-top: -18px;">
                                <div class="col">
                                    <a href="{{route('store_admin.update_category',$cat->id)}}" style="color: #0b72c6"><b>Edit</b></a>

                                </div>
                                <div class="col">

                                    <a onclick="if(confirm('Are you sure you want to delete this category, auto delete all products in this category ?')){ event.preventDefault();document.getElementById('delete-form-{{$cat->id}}').submit(); }"
                                       ><b style="color: red">Delete</b></a>
                                    <form method="post" action="{{route('store_admin.delete_category')}}"
                                          id="delete-form-{{$cat->id}}" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="{{$cat->id}}" name="id">
                                    </form>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>





        </div>


    </div>
    <a href="{{route('store_admin.addcategories')}}" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>

@endsection
