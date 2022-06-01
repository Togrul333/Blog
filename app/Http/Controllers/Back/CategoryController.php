<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::all();
        return view('back.categories.index', $data);
    }

    public function create(Request $request)
    {
        $isExist = Category::whereSlug(Str::slug($request->get('category')))->first();
        if ($isExist) {
            toastr()->error('Bele Kategorya var!!');
            return redirect()->back();
        }
        $category = new Category;
        $category->name = $request->get('category');
        $category->slug = Str::slug($request->get('category'));
        $category->save();
        toastr()->success('Kategory Basariyla olusturuldu');
        return redirect()->back();

    }
    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }
}
