<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Multi Picture <hr> <b></b>
        </h2>
    </x-slot>
    
    <div class="py-12">
       <div class="container">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                     <div class="card-group">
                         @foreach ($images as $multi)
                         <div class="col-md-4 mt-5">
                             <div class="card">
                                 <img src="{{asset($multi-> image)}}" style="height: 300; width:200;">
                             </div>
                         </div>
                             
                         @endforeach
                     </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card header">
                                   Multi Image
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                                       
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label">Multi Image</label>
                                            <input type="file" name="image[]" class="form-control" multiple>
                                            @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                       
                                        <button type="submit" class="btn btn-primary">Add Image</button>
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
