@extends('layout')
@section('content')
@foreach($articles as $article)
<div class="article">
    <h1>{{$article->title}}</h1>
    <h4>Written By: {{explode("@",$article->user->email)[0]}}</h4>
    <div>
        {{$article->content}}
    </div>
    <img src="{{$article->image}}" alt="img" width="300px" />
    <p>Published at: {{str_split($article->created_at,10)[0] }}</p>
    <div style='display:flex;justify-content:space-around'>
        <form method="POST" action="like">
            @csrf
            {{-- @method('put') --}}
            <input type="hidden" name="article_id" value="{{$article->id}}" />
            <button type="submit">{{count($article->likes)}} likes </button>
            <div>
                <span class="tooltiptext">
                    @if($likers[$article->id])
                    {{rtrim($likers[$article->id],', ')}}
                    @else
                    your post is suck
                    @endif
                </span>
            </div>
        </form>
        @if($article->user_id == $id)
        <a href="articles/{{$article->id}}/edit">
            <button>Edit</button>
        </a>
        <form method="POST" action="articles/{{$article->id}}">
            @csrf
            @method("DELETE")
            <button type="submit">Delete</button>
        </form>
        @endif
    </div>
    <form method="POST" action="comment">
        @csrf
        <input type="text" name="content" style='border:1px solid black; margin:15px auto' />
        <input type='hidden' name="article_id" value="{{$article->id}}" />
        <button type="submit">send</button>
    </form>
    @if(count($article->comments) > 0)
    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#comments">show more comments</button>
    @else
    @endif
    <div id="comments" class="collapse">
        @foreach($article->comments as $comment)
        <div>
            <div style="display:flex; justify-content:space-between">
                <p>{{explode("@",$comment->user->email)[0]}} Wrote :</p>
                <form method="POST" action='comment/{{$comment->id}}'>
                    @csrf
                    @method('DELETE')
                    <button type='submit'>X</button>
                </form>
            </div>
            <p>{{$comment->content}}</p>
        </div>
        @endforeach
    </div>
    </form>
</div>
<hr />
@endforeach
@endsection
<?php

?>
