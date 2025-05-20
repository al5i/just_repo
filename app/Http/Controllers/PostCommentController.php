<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostUserComment;
use App\Request\PostCommentRequest;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function comment(PostCommentRequest $request, Post $post)
    {
        $request->validated();

        $user = auth()->user();

        $commentCount = PostUserComment::where('post_id', $post->id)
            ->where('user_id', $user->id)
            ->count();

        if ($commentCount >= 3) {

            return redirect()->back()->withErrors(['msg' => 'Вы не можете добавить более 3 комментариев на этот пост.']);

        }else{

            //$post['message'] = $request['message'];

            $comment = PostUserComment::firstOrCreate(
                [
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                    'message' => $request['message'] //$post->message
                ]
            );

        }

        return back();
    }
}
