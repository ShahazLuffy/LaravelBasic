<x-app-layout>
    <x-slot name="header">
      <div class="p-3 mb-2 bg-secondary text-white"> <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        <h2>
          All Category
          {{-- {{ Auth::user() }} --}}
        </h2>

        </div>
    </x-slot>

      <div class="py-8">
        <div class="container" >
          <div class="row" >
            <div class="col-md-15" >
              <div class="card"  >
                <div class="card-header text-white" style="background-color: #d29de8;"> All Categeroy
                    <div>
                     @if(session('deleted'))
                        <span class="text-danger">{{session('deleted')}}</span>
                     @endif
                    </div>
                  <table class="table table-striped table-dark" >
                         <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Location</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Action</th>

                                  </tr>
                           </thead>
                            <tbody>
                              @php ($row=1) @endphp
                                  @foreach ($brands as $cat)
                                  <tr>
                                    <th scope="row">{{ $row++ }}</th>

                                    {{-- <td> {{ $categories->firstItem()+$loop->index }}</td> --}}
                                    {{-- age bekhaii to safhe dovom radif edame dar bashe --}}
                                    <td> {{ $cat->user_id  }}</td>
                                    <td> {{ $cat->brand_name }}</td>
                                    <td> {{ $cat->brand_image }}</td>
                                    <td> <img src="{{asset($cat->brand_image)}}"  alt="not found" style="height:70px; width:90px;"> </td>
                                    <td> {{ $cat->created_at }}</td>
                                    <td>
                                      @if($cat->updated_at == NULL)
                                      <span class="text-danger">N/A</span>
                                      @else
                                          {{ $cat->updated_at }}
                                      @endif
                                    </td>
                                    <td>
                                      <a href=" {{ url('/brand/edit/'.$cat->id )}}" class="btn btn-info">edit</a>
                                      <a href=" {{ url('/brand/delete/'.$cat->id)}}" onclick="return confirm('are you sure to delete this brand?')" class="btn btn-danger">delete</a>
                                    </td>


                                  </tr>
                                  @endforeach
                            </tbody>
                  </table>
                  {{ $brands->links() }}
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                   {{session('success')}}
                </div>
                @endif
                <div class="card-header"> Add Brand
                  <div class="card-body">
                    <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                            <div class="form-group">
                              <label for="exampleInputEmail1">Brand Name</label>
                              <input type="text " name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type Your Brand Name Here">
                            </div>
                             <div>
                                @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Brand Image</label>
                              <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type Your Category Name Here">
                            </div>
                            <div>
                                 @error('brand_image')
                                    <span class="text-danger">{{ $message }}</span>
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
      </div>


</x-app-layout>

