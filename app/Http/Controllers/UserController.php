<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Request\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $users = User::all();

        return view('user.show',compact('users'));
    }

    public function create(UserRequest $request){

        // TODO: добавить для профиля поле image для добавления фото в профиле.
        //        $originalName = $request->file('image')->getClientOriginalName();
        //        $file = $request->file('image')->storeAs('images', $originalName, 'public');

        $request->validated();

        $this->service->create_profile($request);

        return redirect()->route('user.show');
    }

    //TODO personal_profile($id) for url: /user/{user}
    public function personal_profile(){

        $id = auth()->user();
        $user = User::find($id);

        return view('personal_profile',compact('user'));
        //return view('user.personal_profile',compact('user'));

    }

//    public function update(Request $request)
//    {
//        // Валидация
//        $request->validate([
//            'title' => 'required|string|max:255|'
//        ]);
//
//        // Найти категорию по ID
//        $post = User::find($request->id);
//
//
//        // Обновление категории
//        $post->update([
//            'title' => $request->title
//        ]);
//
//        return redirect()->route('post.show');
//    }

    public function delete(Request $request, User $user)
    {

        $user->delete();

        return redirect()->route('user.show');
    }

    public function count(){

        $users = count(User::all());$posts = count(Post::all());$tags = count(Tag::all());

        return view('admin', compact('users','posts','tags'));
    }

}
