<?php

namespace App\Http\Controllers;

use App\Models\PostUserComment;
use App\Request\PostRequest;
use App\Service\Service;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function show()
    {
        $posts = Post::all();

        return view('post.show',compact('posts'));
    }

    public function create(PostRequest $request){

//        $request->validate([
//            'title' => 'required|unique:posts|max:255',
//            'content' => 'required|unique:posts|max:255',
//            'image' =>  'required|image|max:2048',
//        ]);

        $request->validated();

        $originalName = $request->file('image')->getClientOriginalName();

        $file = $request->file('image')->storeAs('images', $originalName, 'public');

        $this->service->create($request, $file);

        return redirect()->route('post.show');
    }

    public function show_category($id){

        $post = Post::find($id);

        $comments = PostUserComment::where('post_id', $id)->get();
        $user = auth()->user();
        $username = $user->name;

        return view('post.show_category',compact('post','comments', 'username'));

    }

    public function update(Request $request)
    {
        // Валидация
        $request->validate([
            'title' => 'required|string|max:255|'
        ]);

        // Найти категорию по ID
        $post = Post::find($request->id);


        // Обновление категории
        $post->update([
            'title' => $request->title
        ]);

        return redirect()->route('post.show');
    }

    public function delete(Request $request, Post $post)
    {

        $post->delete();

        return redirect()->route('post.show');
    }


}
