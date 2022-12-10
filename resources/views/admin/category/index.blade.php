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
            <div class="col-md-9" >
              <div class="card"  >
                <div class="card-header text-white" style="background-color: #d29de8;"> All Categeroy
                  <table class="table table-striped table-dark" >
                         <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">ID 2</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Action</th>

                                  </tr>
                           </thead>
                            <tbody>
                              @php ($row=1) @endphp
                                @foreach ($categories as $cat)
                                    @if ($cat->deleted_at != null)
                                        continue;
                                    @else   
                                        <tr>
                                            <th scope="row">{{ $row++ }}</th>
                                            <td> {{ $cat->id }}</td>
                                            <td> {{ $categories->firstItem()+$loop->index }}</td>
                                            {{-- age bekhaii to safhe dovom radif edame dar bashe --}}
                                            <td> {{ $cat->user_id  }}</td>
                                            <td> {{ $cat->name }}</td>
                                            <td> {{ $cat->category_name}}</td>
                                            <td> {{ $cat->created_at }}</td>
                                            <td>
                                            @if($cat->updated_at == NULL)
                                            <span class="text-danger">N/A</span>
                                            @else
                                                {{ $cat->updated_at }}
                                            @endif
                                            </td>
                                            <td>
                                            <a href=" {{ url('/category/edit/'.$cat->id )}}" class="btn btn-info">edit</a>
                                            <a href=" {{ url('/softdelete/category/'.$cat->id)}}" class="btn btn-danger">delete</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                  </table>
                  {{ $categories->links() }}
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
                <div class="card-header"> Add Category
                  <div class="card-body">
                    <form action="{{ route('store.category') }}" method="POST">
                      @csrf
                            <div class="form-group">
                              <label for="exampleInputEmail1">Category Name</label>
                              <input type="text " name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type Your Category Name Here">
                            </div>
                             <div>
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
{{--  Trash part  --}}
       <div class="py-8">
        <div class="container" >
          <div class="row" >
            <div class="col-md-9" >
              <div class="card"  >
                <div class="card-header text-white" style="background-color: #3a58ac;"> Trashed Categeroy
                  <table class="table table-striped table-dark" >
                         <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">ID 2</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Deleted At</th>
                                    <th scope="col">Action</th>
                                  </tr>
                           </thead>
                            <tbody>
                              @php ($row=1) @endphp
                                  @foreach ($trashCats as $cat)
                                  <tr>
                                    <th scope="row">{{ $row++ }}</th>
                                    <td> {{ $cat->id }}</td>
                                    <td> {{ $trashCats->firstItem()+$loop->index }}</td>
                                    {{-- age bekhaii to safhe dovom radif edame dar bashe --}}
                                    <td> {{ $cat->user_id  }}</td>
                                    <td> {{ $cat->category_name}}</td>
                                    <td> {{ $cat->created_at }}</td>
                                    <td> {{ $cat->deleted_at }}</td>
                                    <td>
                                      <a href=" {{ url('/category/restore/'.$cat->id) }}" class="btn btn-info">restore</a>
                                      <a href=" {{ url('/pdelete/category/'.$cat->id) }}" class="btn btn-danger">permanent delete</a>
                                    </td>
                                  </tr>
                                  @endforeach
                            </tbody>
                  </table>
                  {{ $trashCats->links() }}
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

</x-app-layout>

