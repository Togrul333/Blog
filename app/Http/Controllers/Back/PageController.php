<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $date['pages'] = Page::all();
        return view('back.pages.index', $date);
    }
    public function orders(Request $request)
    {
        print_r($request->get('orders'));

    }

    public function create()
    {
        return view('back.pages.create');
    }

    public function post(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image',
        ]);
        $last = Page::orderBy('order', 'desc')->first();

        $page = new Page();
        $page->title = $request->get('title');
        $page->content = $request->get('content');
        $page->order = $last->order + 1;
        $page->slug = Str::slug($request->get('title'));
        if ($request->hasFile('image')) {
            $ImageName = Str::slug($request->get('title')) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $ImageName);
            $page->image = '/uploads/' . $ImageName;
        }
        $page->save();
        toastr()->success('Basariyla olusturuldu');
        return redirect()->route('admin.page.index');
    }

    public function update($id)
    {
        $data['page']=Page::findOrFail($id);
        return view('back.pages.update',$data);
    }
    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image',
        ]);
        $page =Page::findOrFail($id);
        $page->title = $request->get('title');
        $page->content = $request->get('content');
        $page->slug = Str::slug($request->get('title'));
        if ($request->hasFile('image')) {
            $ImageName = Str::slug($request->get('title')) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $ImageName);
            $page->image = '/uploads/' . $ImageName;
        }
        $page->save();
        toastr()->success('Basariyla Guncellendi');
        return redirect()->route('admin.page.index');
    }

    public function delete($id)
    {
        Page::find($id)->delete();
        toastr()->success('Page Basariyla silindi');
        return redirect()->route('admin.page.index');
    }
}
