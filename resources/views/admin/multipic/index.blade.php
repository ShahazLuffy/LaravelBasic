<x-app-layout>
    <x-slot name="header">
      <div class="p-3 mb-2 bg-secondary text-white"> <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        <h2>
          Multi Pic
          {{-- {{ Auth::user() }} --}}
        </h2>

        </div>
    </x-slot>

      <div class="py-8">
        <div class="container" >
          <div class="row" >
            <div class="col-md-8" >
              <div class="card-group"  >
                @foreach($multipic as $img)
                  <div class="col-md-4 mt-5 px-4">
                    <div class="card">
                        <img src=" {{ asset($img->image) }}" alt="NOT FOUND">
                    </div>
                  </div>
                @endforeach
            </div>
          </div>
          <div class="col-md-3">
              <div class="card">
                <div class="card-header"> Multi Image
                  <div class="card-body">
                    <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                      @csrf

                            <div class="form-group">
                              <label for="exampleInputEmail1">Brand Image</label>
                              <input type="file" name="image[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" multiple="">
                              <!-- multiple attribute to select multiple image a;sp name="image[]" for multipic -->
                            </div>

                            <button type="submit" class="btn btn-primary">Add Image </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>


</x-app-layout>

