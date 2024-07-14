<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'articleSearch');
    }    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles= Article::where('is_accepted', true)->orderBy('created_at','desc')->get();
        return view ('article.index', compact('articles'));
    }

    public function articleSearch(Request $request){
      $query = $request->input('query');
    
      $articles = Article::where('is_accepted', true)
        ->where(function ($searchQuery) use ($query) {
          $searchQuery->where('title', 'LIKE', '%' . $query . '%')
                     ->orWhere('subtitle', 'LIKE', '%' . $query . '%')
                     ->orWhere('body', 'LIKE', '%' . $query . '%')
                     ->orWhereHas('category', function ($userQuery) use ($query) {
                        $userQuery->where('name', 'LIKE', '%' . $query . '%');
                      })                   
                     ->orWhereHas('user', function ($userQuery) use ($query) {
                       $userQuery->where('name', 'LIKE', '%' . $query . '%');
                     });
        })
        ->orderBy('created_at', 'desc')
        ->with('user') // Join tabella
        ->with('category') // Join tabella
        ->get();
    
      return view('article.search-index', compact('articles', 'query'));
    }
    
    

    public function byCategory(Category $category)
    {
        $articles=$category->articles()->where('is_accepted', true)->orderBy('created_at', 'desc')->get();
        return view('article.byCategory', compact('category','articles'));
    }

    public function byUser (User $user)
    {
        $articles=$user->articles()->orderBy('created_at', 'desc')->get();
        return view('article.byUser', compact('user','articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|unique:articles|min:5|max:22',
            'subtitle'=> 'required|min:5|max:22',
            'body'=> 'required|min:10',
            'image'=> 'image|required',
            'category'=> 'required',
            'tags'=>'required',
        ]);

        $article= Article::create([
            'title'=> $request-> title,
            'subtitle'=> $request-> subtitle,
            'body'=> $request-> body,
            'image'=> $request-> file('image')->store ('public/images'),
            'category_id'=> $request-> category,
            'user_id'=> Auth::user()->id,
        ]);

        $tags= explode(',', $request->tags);

        foreach ($tags as $i=> $tag) {
            $tags[$i] = trim($tag);    
        }

        foreach ($tags as $tag) {
            $newTag= Tag::updateOrCreate(
                ['name'=> $tag],
                ['name'=> strtolower($tag)],
            );
            $article->tags()->attach($newTag);
        }
        
        return redirect (route('homepage'))->with('message', 'Articolo creato e pronto per essere revisionato.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view ('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'=> 'required|min:5|max:22|unique:articles,title,'.$article->id,
            'subtitle'=> 'required|min:5|max:22',
            'body'=> 'required|min:10',
            'image'=> 'image',
            'category'=> 'required',
            'tags'=>'required',
        ]);

        $article->update([
            'title'=> $request-> title,
            'subtitle'=> $request-> subtitle,
            'body'=> $request-> body,
            'category_id'=> $request-> category,
        ]);

        if ($request->image) {
            Storage::delete($article->image);
            $article->update([
                'image'=> $request->file('image')->store('public/image'),
            ]);
        }

        $tags= explode(',', $request->tags);

        foreach ($tags as $i=> $tag) {
            $tags[$i] = trim($tag);    
        }

        $newTags=[];

        foreach ($tags as $tag) {
            $newTag= Tag::updateOrCreate(
                ['name'=> $tag],
                ['name'=> strtolower($tag)],
            );
            $newTags[]= $newTag->id;
        }

        $article->tags()->sync($newTags);

        return redirect (route('writer.dashboard'))->with('message', 'Articolo aggiornato correttamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        foreach ($article->tags as $tag) {
            $article->tags()->detach($tag);
        }

        $article->delete();

        return redirect(route('writer.dashboard'))->with('message','Articolo eliminato correttamente.');
    }
}
