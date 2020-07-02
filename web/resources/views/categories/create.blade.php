@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3>{{ isset($category) ? 'Edit category' : 'Create category'}}</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store')}}"
                  method="POST">
                {{ csrf_field() }}
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ isset($category) ? $category->name : ''}}"
                           name="name">
                </div>
                <div class="form-group">
                    <button class="btn btn-success"
                            type="submit">{{ isset($category) ? 'Update category' : 'Create category'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

