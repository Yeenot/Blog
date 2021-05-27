<?php
namespace App\Services\Posts;

use App\Models\Post;

class DeletePost
{
    public function execute($postId)
    {
        return Post::find($postId)->delete();
    }
}