<?php
namespace App\Services\Posts;

use App\Models\Post;

class GetPosts
{
    public function execute()
    {
        return Post::with('user.profile')->orderBy('created_at', 'desc')->get();
    }
}