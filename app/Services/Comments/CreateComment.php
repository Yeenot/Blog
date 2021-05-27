<?php
namespace App\Services\Comments;

use App\Models\Post;

class CreateComment
{
    public function execute($postId, $data)
    {
        return Post::find($postId)->comments()->create($data);
    }
}