@extends('layouts.admin')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Product') }}</h1>

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

     
        <div class="col-lg order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                    <a class="btn btn-primary btn-icon-text pull-right" href="{{ route('admin.products.create') }}">
            <i data-feather="plus-square"></i> Add  </a>
       
                </div>

                <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>

                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th></th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $product)

<tr>
    <td>{{ $product->title }}</td>
    <td><img src="{{ $product->image_url }}" width="50px" height="50px"/></td>
    <td>{{$product->price}}</td>
    <td>{{ $product->quantity }}</td>
   <td>{{ ($product->status == 1)?'Published':'Draft'}}</td>
   <td> <a class="btn btn-warning btn-icon"
    href="{{ route('admin.products.edit',$product->id) }}">
    <i data-feather="edit"></i>Edit
</a>
                                    
         

<form method="POST" action="{{route('admin.products.destroy',$product->id)}}" accept-charset="UTF-8" style="display:inline">
{{ method_field('DELETE') }}
{{ csrf_field() }}
<button type="submit" class="btn btn-danger btn-icon" title="Delete User Role" onclick="return confirm('Are you sure?')"><i
data-feather="trash"></i>Delete </button>
</form> 

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

    <script>
    $('#dataTable').DataTable();
</script>

@endsection


 <!-- Page level plugins -->
 <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>


<!-- Custom scripts for all pages-->


 <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <!-- Core plugin JavaScript-->
   <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

 <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>


 <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
 
