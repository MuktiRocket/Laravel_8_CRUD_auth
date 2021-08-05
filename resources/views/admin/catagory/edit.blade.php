<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Edit Category <hr> <b></b>
        </h2>
    </x-slot>

    <div class="py-12">
       <div class="container">
           <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card header">
                                    Edit Category  
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('catagory/update/'.$catagories -> id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                        <label class="form-label">Update Category Name</label>
                                        <input type="text" name="catagory" class="form-control" value="{{$catagories -> catagory}}">
                                        @error('catagory')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                       
                                        <button type="submit" class="btn btn-primary">Update Category</button>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>
