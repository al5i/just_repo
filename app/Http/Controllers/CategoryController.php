<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show()
    {
        $categories = Category::all();

        return view('category.show',compact('categories'));
    }

    public function create(Request $request){

        //dd($request->title);

        $request->validate([
            'title' => 'required|unique:categories|max:255'
        ]);

        Category::firstOrCreate([
            'title' => $request->title
        ]);

        return redirect()->route('category.show');
    }

    public function show_category($id){

        $category = Category::find($id);

        return view('category.show_category',compact('category'));

    }

    public function update(Request $request)
    {
        // Валидация
        $request->validate([
            'title' => 'required|string|max:255|'
        ]);

        // Найти категорию по ID
        $category = Category::find($request->id);


        // Обновление категории
        $category->update([
            'title' => $request->title
        ]);

        return redirect()->route('category.show');
    }

    public function delete(Request $request, Category $category)
    {

        $category->delete();

        return redirect()->route('category.show');
    }


}
