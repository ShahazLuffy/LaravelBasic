<x-app-layout>
    <x-slot name="header">
      <div class="p-3 mb-2 bg-secondary text-white"> <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }} <br>
            <!-- hi {{Auth::user()->name}}  -->
            Hi {{Auth::user()->name}}
             {{-- {{$users}}   --}}
        </h2></div>

        <div posation="relative">
        <button style=" display: block;  margin-left: auto; margin-right: 0;" type="button" class="btn btn-primary position-relative">
        Total Users
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        {{$users->count()}}

    </span>
        </button>
    </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

    <div class="py-12">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Created At</th>
      <th scope="col">Updated At</th>
    </tr>
  </thead>
    @php ($i = 1)
    @foreach($users as $asdf)
  <tbody>
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$asdf->id}}</td>
      <td>{{$asdf->name}}</td>
      <td>{{$asdf->email}}</td>
      <td>{{$asdf->created_at}}</td>
      <td>{{$asdf->updated_at}}</td>
      @endforeach
    </tr>

  </tbody>
</table>
</div>
</div>
    </div>
</x-app-layout>
