@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('tags.create') }}" class="btn btn-success float-right">Create tag</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            <h3>tags</h3>
        </div>
        <div class="card-body">
            @if($tags->count() > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Article counts</th>
                    </thead>

                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>
                                {{ $tag->name }}
                            </td>
                            <td>
                                {{$tag->articles->count()}}
                            </td>
                            <td>
                                <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="handleDelete({{ $tag->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <form action="" method="POST" id="deleteTagsForm">
                        {{ csrf_field() }}
                        @method('Delete')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete tag</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Do you wish to delete this Tag??</p>
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
            let form = document.getElementById('deleteTagsForm')

            form.action = '/tags/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection
