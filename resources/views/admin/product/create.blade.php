@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

       
        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.products.store') }}"  enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="row">

<div class="col-lg-6">
<div class="form-group">
<label> Name</label>
<input name="title" id="title" class="form-control" autocomplete="off" /></div>
</div>

        <div class="col-lg-6">
        <div class="form-group">
        <label>Quantity</label>
        <input name="qty" id="qty" type="number" class="form-control" autocomplete="off" />
        </div>
        </div>

        <div class="col-lg-6">
        <div class="form-group">
        <label>Price</label>
        <input name="price" id="price" type="number" class="form-control" autocomplete="off" />
        </div>
        </div>

        <div class="col-lg-6 ">
            <div class="form-group">
                <label for="team2" class="mb-2">Category</label>
                <select multiple class="form-control" name="category[]" id="category">
                    @foreach($categories as $cat)
                  <option value="{{$cat->id}}" >{{$cat->category}}</option>
                 @endforeach
                </select>
              </div>
        </div>
        <div class="col-lg-6 ">
            <div class="form-group">
                <label for="team2" class="mb-2">Status</label>
                <select class="form-control" name="status" id="status">
                  <option value="1" >Published</option>
                 <option value="0" >Draft</option>
                </select>
              </div>
        </div>
        <div class="col-lg-6 mb-2">
            <div class="form-group">
                <label for="team1" class="mb-2">Image</label>                       
               <input type="file" class="form-control" name="image" id="image" value="" />
             
            </div>
        </div>
        
<div class="col-lg-6" align="right">
<input  type="submit" value="Submit" class="btn btn-primary">
<a class="btn btn-secondary" href="{{ route('admin.products.index')}}"> Back</a>
</div>
</div>

                        

                      
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
