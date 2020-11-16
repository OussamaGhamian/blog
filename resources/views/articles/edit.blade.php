@extends('layout')
@section('content')
<form method="POST" action="/articles/{{$article->id}}">
    @csrf
    @method('PUT')
    <label for="title">Title</label>
    <br />
    <input type="text" name="title" id="title" value="{{$article->title}}" />
    <br />
    <label for="content">Content</label>
    <br />
    <textarea type="text" name="content" id="content" cols="60" rows="20">{{$article->content}}</textarea>
    <br />
    <button type="submit">Edit</button>
</form>
@endsection
