<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Brand <hr> <b></b>
        </h2>
    </x-slot>

    <div class="py-12">
       <div class="container">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                      @if(session('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert" id="crossbutton">
                   <strong>{{ session('success') }}</strong>  
                   <button type="button" class="close" id="closebutton">&times;</button>
                    </div>
                    @endif
                       <div class="card header">
                         <b>All Brand</b>
                       </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No.</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                {{-- @php($i=1) --}}
                                <tbody>
                                    
                                    @foreach ($brands as $brand)
                                <tr>
                                    <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                                    <td>{{$brand -> brand_name}}</td>
                                    <td><img src="{{ asset($brand -> brand_image) }}" style="height: 80px; width: 140px;"></td>
                                    <td>{{Carbon\Carbon::parse($brand -> created_at) ->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{url('brand/edit/'.$brand->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{url('brand/delete/'.$brand->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$brands -> links()}}
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card header">
                                    Add brand
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">brand Name</label>
                                            <input type="text" name="brand_name" class="form-control">
                                            @error('brand_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>



                                        <div class="mb-3">
                                            <label class="form-label">brand Image</label>
                                            <input type="file" name="brand_image" class="form-control">
                                            @error('brand_image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                       
                                        <button type="submit" class="btn btn-primary">Add Brand </button>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>




<script>
    $(document).ready(function(){
    $("#closebutton").click(function(){
  $("#crossbutton").remove();
});
});
</script>
