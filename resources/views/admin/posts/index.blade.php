@extends('layouts.admin')

@section('content')
<div class="container">
    @if (session('post-deleted'))
    <div class="alert alert-success">
        <div>Post deleted successfully</div>
        {{session('post-deleted')}}
    </div>
    @endif
<h1 class="mb-4">Blog Archive</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tilte</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->created_at->format('d/m/Y')}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
            <td>
            <a class="btn btn-success" href="{{route('admin.posts.show', $post->id)}}">SHOW</a>
            </td>
            <td>
                <a class="btn btn-primary" href="{{route('admin.posts.edit', $post->id)}}">EDIT</a>
            </td>
            <td>
            <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
            @csrf
            @method('DELETE')

            <input class="btn btn-danger" type="submit" value="Delete">
            </form>
            </td>
            </tr>
        @endforeach
    </tbody>
</table>
@foreach ($posts as $post)
    <article>
    <h2>{{$post->title}}</h2>
    <p>{{$post->body}}</p>
    @if (! $loop->last)
        <hr>
    @endif
    </article>
@endforeach
<div class="wrap-pagination mt-5 d-flex justify-content-center">
    {{$posts->links()}}
</div>
</div>
@endsection