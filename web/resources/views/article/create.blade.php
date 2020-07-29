@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3>{{ isset($article) ? 'Edit article' : 'Create article'}}</h3>
        </div>
        <div class="card-body">
            @include('partial.error')
            <form action="{{ isset($article) ? route('article.update', $article->id) : route('article.store')}}"
                  method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                @if(isset($article))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" value="{{ isset($article) ? $article->title : ''}}"
                           name="title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" cols="5"
                              rows="5">{{ isset($article) ? $article->description : ''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="content-article">Content</label>
                    <input id="content-article" value="{{ isset($article) ? $article->content : ''}}" type="hidden"
                           name="content">
                    <trix-editor input="content-article"></trix-editor>
                </div>


                <div class="form-group">
                    <label for="published_at">Published_at</label>
                    <input id="published_at" type="text" class="form-control"
                           value="{{ isset($article) ? $article->published_at : ''}}"
                           name="published_at">
                </div>

                @if(isset($article))
                    <div class="form-group">
                        <img width="100%" src="{{URL::to('/')}}/storage/{{$article->image}}" alt="">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" value="{{ isset($article) ? $article->image : ''}}"
                           name="image">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if(isset($article))
                                    @if($category->id == $article->category_id)
                                    selected
                                @endif
                                @endif
                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                @if($tags->count() > 0)
                    <div class="form-group">
                        <label for="tags">tags</label>
                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    @if(isset($article))
                                        @if($article->hasTag($tag->id))
                                            selected
                                        @endif
                                    @endif
                                >{{$tag->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <button class="btn btn-success"
                            type="submit">{{ isset($article) ? 'Update article' : 'Create article'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true
        })
        $(document).ready(function () {
            $('.tags-selector').select2();
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
