<?php

namespace App\Http\Controllers;

use App\Events\ArticleWasCreated;
use App\Events\UserAddsArticle;
use App\Events\UserDeletesArticle;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('articles.index', [
            'articles' => Article::all()
        ]);
    }

    public function create()
    {
        $this->authorize('create', Article::class);

        return view('articles.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $article = (new Article)->fill($request->all());
        $article->user()->associate(auth()->user());
        $article->save();


        /** @var User $user */
        $user = auth()->user();

        event(new ArticleWasCreated($user));

        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article
        ]);
    }

    public function edit(Article $article)
    {
        $this->authorize('edit', $article);

        return view('articles.edit', [
            'article' => $article
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $article->update($request->all());

        return redirect()->route('articles.edit', $article);
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        /** @var User $user */
        $user = auth()->user();

        event(new ArticleWasCreated($user));

        return redirect()->route('articles.index');
    }
}
