@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success float-right">Create category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            <h3>Categories</h3>
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Article counts</th>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                {{$category->articles->count()}}
                            </td>
                            <td>
                                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="handleDelete({{ $category->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <form action="" method="POST" id="deleteCategoryForm">
                        {{ csrf_field() }}
                        @method('Delete')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Do you wish to delete this category?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else
                <h3 class="text-center">No categories yet</h3>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            let form = document.getElementById('deleteCategoryForm')

            form.action = '/categories/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection
