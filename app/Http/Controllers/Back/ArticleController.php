<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{

    public function index()
    {
        $data['articles'] = Article::orderBy('created_at', 'ASC')->get();
        return view('back.articles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::all();
        return view('back.articles.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image',
        ]);

        $article = new Article;
        $article->title = $request->get('title');
        $article->category_id = $request->get('category_id');
        $article->content = $request->get('content');
        $article->slug = Str::slug($request->get('title'));
        if ($request->hasFile('image')) {
            $ImageName = Str::slug($request->get('title')) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $ImageName);
            $article->image = '/uploads/' . $ImageName;
        }
        $article->save();
        toastr()->success('Basarili', 'Basariyla olusturuldu');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories'] = Category::all();
        $data['article'] = Article::findOrFail($id);
        return view('back.articles.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'image',
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->get('title');
        $article->category_id = $request->get('category_id');
        $article->content = $request->get('content');
        $article->slug = Str::slug($request->get('title'));
        if ($request->hasFile('image')) {
            $ImageName = Str::slug($request->get('title')) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $ImageName);
            $article->image = '/uploads/' . $ImageName;
        }
        $article->save();
        toastr()->success('Basarili', 'Basariyla guncellendi');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();
        toastr()->success('Makale Basariyla silindi');
        return redirect()->route('admin.articles.index');
    }

    public function trashed()
    {
        $articles = Article::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();

        return view('back.articles.trashed', compact('articles'));
    }

    public function recover($id)
    {
        Article::onlyTrashed()->find($id)->restore();
        toastr()->success('Makale Basariyla kurtarildi');
        return redirect()->route('admin.articles.index');
    }
    public function hardDelete($id)
    {
        $article = Article::onlyTrashed()->find($id);

        if (File::exists(public_path($article->image))) {
           File::delete(public_path($article->image));
        }
        $article->forceDelete();
        toastr()->success('Makale Basariyla birdefelik silindi');
        return redirect()->route('admin.articles.index');
    }
}
