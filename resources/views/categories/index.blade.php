@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a class="btn btn-success" href="{{route('categories.create')}}">Add Category</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if($categories->count()>0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Posts Count</th>
                    <th></th>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                {{$category->posts->count()}}
                            </td>
                            <td>
                                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm">
                                    Edit
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="" method="POST" id="deleteCategoryForm">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this category?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div>No records found!</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id){
            var form = document.getElementById('deleteCategoryForm')
            form.action = '/categories/'+id
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
