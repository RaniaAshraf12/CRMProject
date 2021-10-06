<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Edit Category<b> </b>
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
                <div class="container">
                    <div class="row">
                        
                    <div class="col-md-8">
                        <div class="card" >
                            <div class="card-header">
                                Edit Category
                              </div>
                            <div class="card-body">
                                <form action="{{url('category/update/'.$categories->id)}}" method="POST">
                                     @csrf
                                    <div class="row mb-4">
                                      <label for="inputEmail3" class="col-sm-4 col-form-label"> Update Category Name</label>
                                      <div class="col-sm-8">
                                        <input type="text" name="category_name" class="form-control" id="inputEmail3" value="{{$categories->category_name}}">
                                        @error('category_name')
                                        <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
                                      </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Edit Category</button>
                                  </form>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
