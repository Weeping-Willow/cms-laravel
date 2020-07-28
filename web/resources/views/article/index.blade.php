@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('article.create') }}" class="btn btn-success float-right">Create Article</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            <h3>Articles</h3>
        </div>
        <div class="card-body">
            @if($articles->count() > 0)
                <table class="table">
                <thead>
                <th>Title</th>
                <th>Image</th>
                <th>Category</th>
                <th></th>
                <th></th>
                </thead>

                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>
                            <img width="120px" height="60px" src="{{URL::to('/')}}/storage/{{$article->image}}" alt="">
                        </td>
                        <td>
                            {{ $article->title }}
                        </td>
                        <td>
                            <a href="{{ route('categories.edit',$article->category->id) }}">
                                {{ $article->category->name }}
                            </a>
                        </td>
                        @if(!$article->trashed())
                            <td>
                                <a href="{{route('article.edit',$article->id)}}" class="btn btn-sm btn-info">Edit</a>
                            </td>
                        @else
                            <td>
                                <form action="{{route('restore-articles',$article->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-info btn-sm" type="submit">Restore</button>
                                </form>
                            </td>
                        @endif
                        <td>
                            <form action="{{ route('article.destroy',$article->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    {{ $article->trashed() ? 'Delete': 'Trash' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <h3 class="text-center">No Articles Yet</h3>
            @endif
        </div>
@endsection
