<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Articles\Article;
use App\Http\Resources\ArticleResources;
use App\Http\Resources\ArticleCollection;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::get();
        // return new ArticleCollection($article); using collection
        return ArticleResources::collection($article);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $articles = auth()->user()->articles()->create($this->articleStore($request));

        return $articles;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ArticleResources($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($this->articleStore());
        return new ArticleResources($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json('Article has been deleted', 200);
    }

    public function articleStore()
    {
        return [
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'body' => request('body'),
            'subject_id' => request('subject'),
        ];
    }
}
