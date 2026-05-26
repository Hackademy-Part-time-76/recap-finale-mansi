<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$articles = Article::oldest('created_at')->take(5);
        //$articles = Article::latest('created_at')->take(5);
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('articles.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('covers', 'public');
        }
        $article = Article::create([
            'title' => $request->title,
            'body' => $request->input('body'),
            'image' => $image,
            'user_id' => Auth::user()->id
        ]);

        $article->tags()->attach($request->tags);

        return redirect()->route('articles.index')->with('success', 'Articolo inserito con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $image = $article->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('covers', 'public');
        }
        $article->update([
            'title' => $request->title,
            'body' => $request->input('body'),
            'image' => $image,
        ]);


        // $article->tags()->deatach();
        // $article->tags()->attach($request->tags);

        $article->tags()->sync($request->tags);


        return redirect()->route('articles.index')->with('success', 'Articolo modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->tags()->deatach();
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Articolo eliminato con successo!');
    }
}
