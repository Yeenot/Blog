<?php
namespace App\Services\Posts;

use App\Models\Post;

class CreatePost
{
    public function execute($data)
    {
        return Post::create($data);
    }
}