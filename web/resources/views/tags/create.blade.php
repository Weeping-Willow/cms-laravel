@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3>{{ isset($tag) ? 'Edit tag' : 'Create tag'}}</h3>
        </div>
        <div class="card-body">
            @include('partial.error')
            <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store')}}"
                  method="POST">
                {{ csrf_field() }}
                @if(isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ isset($tag) ? $tag->name : ''}}"
                           name="name">
                </div>
                <div class="form-group">
                    <button class="btn btn-success"
                            type="submit">{{ isset($tag) ? 'Update tag' : 'Create tag'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
