<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class PostLikeController extends Controller
{
    public function Like(Post $post)
    {
        $user = auth()->user();
        $user->likedPosts()->toggle($post->id);

        return back();
    }
}

