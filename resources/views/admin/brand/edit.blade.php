<x-app-layout>
    <x-slot name="header">
      <div class="p-3 mb-2 bg-secondary text-white"> <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        <h2>
          Edit Brand
          {{-- {{ $edit_brand }} --}}
        </h2>

        </div>
    </x-slot>

      <div class="py-8">
        <div class="container" >
          <div class="row" >

            <div class="col-md-3">
              <div class="card">
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                   {{session('success')}}
                </div>
                @endif
                <div class="card-header"> Add New Brand
                  <div class="card-body">
                    <form action="{{ url('brand/update/'.$edit_brand->id)  }}" method="POST" enctype="multipart/form-data">
                      @csrf
                            <input type="hidden" value="{{ $edit_brand->brand_image }}" name="old_image">
                             {{-- az in input hidden estefade mikonim ta address image ghadimi ro dashte bashim --}}
                            <div class="form-group">
                              <label for="exampleInputEmail1">NewBrand Name</label>
                              <input
                              type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type Your Brand Name Here"
                               value="{{ $edit_brand->brand_name }}"
                              >
                                <div>
                                 @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>

                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">New Brand Image</label>
                              <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1"
                              value="{{ $edit_brand->brand_image }}"
                              >
                            </div>
                            <div>
                                 @error('brand_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ asset($edit_brand->brand_image) }}" alt="not found" style="width: 170 px; height:170 px">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Brand </button>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


</x-app-layout>

