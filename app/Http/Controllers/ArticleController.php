<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function validateArticle($request)
    {
        return $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            'user_id' => 'required'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $likers = array();
        foreach (Article::all() as $article) {
            $likers[$article->id] = '';
            foreach ($article->likes as $like) {
                $likers[$article->id] = $likers[$article->id] . explode("@", User::find($like->user_id)->email)[0] . ", ";
            }
        }
        return view('articles.index', [
            'articles' => Article::all(),
            'id' => Auth::user()->id,
            'likers' => $likers,
        ]);
    }
    public function myArticles()
    {
        $likers = array();
        foreach (Article::all() as $article) {
            $likers[$article->id] = '';
            foreach ($article->likes as $like) {
                $likers[$article->id] = $likers[$article->id] . explode("@", User::find($like->user_id)->email)[0] . ", ";
            }
        }
        return view('articles.index', ['articles' => Article::whereUserId(Auth::user()->id)->get(), 'id' => Auth::user()->id, "likers" => $likers]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $article = $request->except(['image']);
        $article['image'] = "images/" . $imageName;
        $article['user_id'] = Auth::user()->id;
        Article::create($article);
        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // note: persisting convention will help Laravel to do some shortcuts, ex: using same name for parameter and wildcard in the associative route will return the source directly
        return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->validate([
            'title' => 'required',
            "content" => 'required'
        ]));
        return redirect('/articles/' . $article->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {

        File::delete($article->image);
        $article::destroy($article->id);
        return redirect('articles');
    }
}
