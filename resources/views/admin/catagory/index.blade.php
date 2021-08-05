<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Catagory <hr> <b></b>
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
                         <b>All Category</b>
                       </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No.</th>
                                    <th scope="col">Catagory Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                {{-- @php($i=1) --}}
                                <tbody>
                                    
                                    @foreach ($catagories as $catagory)
                                <tr>
                                    <th scope="row">{{$catagories->firstItem()+$loop->index}}</th>
                                    <td>{{$catagory -> catagory}}</td>
                                    <td>{{$catagory -> user -> name}}</td>
                                    <td>{{Carbon\Carbon::parse($catagory -> created_at) ->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{url('catagory/edit/'.$catagory->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{url('softdelete/catagory/'.$catagory->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$catagories -> links()}}
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card header">
                                    Add Catagory
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('store.catagory') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                        <label class="form-label">Catagory Name</label>
                                        <input type="text" name="catagory" class="form-control">
                                        @error('catagory')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                       
                                        <button type="submit" class="btn btn-primary">Add Catagory</button>
                                    </form>
                                </div> 
                            </div>
                        </div>
                   
                



                <div class="container" style="padding: 50px;">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card header">
                                  <b>Trash Category</b>
                                </div>
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">SL No.</th>
                                             <th scope="col">Catagory Name</th>
                                             <th scope="col">User</th>
                                             <th scope="col">Created At</th>
                                             <th scope="col">Action</th>
                                         </tr>
                                         </thead>
                                         {{-- @php($i=1) --}}
                                         <tbody>
                                             
                                             @foreach ($trashcat as $catagory)
                                         <tr>
                                             <th scope="row">{{$catagories->firstItem()+$loop->index}}</th>
                                             <td>{{$catagory -> catagory}}</td>
                                             <td>{{$catagory -> user -> name}}</td>
                                             <td>{{Carbon\Carbon::parse($catagory -> created_at) ->diffForHumans()}}</td>
                                             <td>
                                                 <a href="{{url('catagory/restore/'.$catagory->id)}}" class="btn btn-info">Restore</a> <br>
                                                 <a href="{{url('pdelete/catagory/'.$catagory->id)}}" class="btn btn-danger">Permanent
                                                    Delete</a>
                                             </td>
                                         </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                     {{$trashcat -> links()}}
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                     
                                </div> 
                            </div>
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
