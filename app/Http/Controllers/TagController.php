<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
class TagController extends Controller
{
    public function show()
    {
        $tags = Tag::all();

        return view('tag.show',compact('tags'));
    }

    public function create(Request $request){

        //dd($request->title);

        $request->validate([
            'title' => 'required|unique:categories|max:255'
        ]);

        Tag::firstOrCreate([
            'title' => $request->title
        ]);

        return redirect()->route('tag.show');
    }

    public function show_category($id){

        $tag = Tag::find($id);

        return view('tag.show_category',compact('tag'));

    }

    public function update(Request $request)
    {
        // Валидация
        $request->validate([
            'title' => 'required|string|max:255|'
        ]);

        // Найти категорию по ID
        $tag = Tag::find($request->id);


        // Обновление категории
        $tag->update([
            'title' => $request->title
        ]);

        return redirect()->route('tag.show');
    }

    public function delete(Request $request, Tag $tag)
    {

        $tag->delete();

        return redirect()->route('category.show');
    }


}
