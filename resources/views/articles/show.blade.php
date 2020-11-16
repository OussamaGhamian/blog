@extends('layout')
@section('content')
<div style="display:flex; flex-direction:column">
    <h1>Showing one view {{$article->title}}</h1>
    <div>
        {{$article->content}}
    </div>
    <img src="/{{$article->image}}" alt="img" width="400px" />
    <p>Published at: {{str_split($article->created_at,10)[0] }}</p>
</div>
@endsection
