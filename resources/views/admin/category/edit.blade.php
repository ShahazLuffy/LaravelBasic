<x-app-layout>
    <x-slot name="header">
      <div class="p-3 mb-2 bg-secondary text-white"> <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <h2>
          Edit Category
        </h2>

        </div>
    </x-slot>

      <div class="py-12">
        <div class="container" >
          <div class="row" >
            <div class="col-md-4">
              <div class="card">
                @if(session('updated'))
                <div class="alert alert-success" role="alert">
                   {{session('updated')}}
                </div>
                @endif
                <div class="card-header"> Update Category
                  <div class="card-body">
                    <form action="{{ url('category/update/'.$edit_item->id) }}" method="POST">
                      @csrf
                            <div class="form-group">
                              <label for="exampleInputEmail1">New Category Name</label>
                              <input type="text " name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type Your new Category Name Here" value="{{ $edit_item->category_name }}">
                            </div>
                             <div>
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Category </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</x-app-layout>

