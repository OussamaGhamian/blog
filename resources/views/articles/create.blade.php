@extends('layout')
@section('content')
<form method='POST' action="/articles" enctype="multipart/form-data">
    @csrf
    <label for="title">Title</label>
    <br />
    <input type="text" name="title" id="title" />
    <br />
    <label for="image">Image</label>
    <br />
    <input type="file" name="image" id="image" />
    <br />
    <label for="content">Content</label>
    <br />
    <textarea type="text" name="content" id="content" cols="60" rows="20"></textarea>
    <br />
    <button type="submit">Create</button>
</form>
@endsection
