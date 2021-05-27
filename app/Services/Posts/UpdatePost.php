<?php
namespace App\Services\Posts;

use App\Models\Post;

class UpdatePost
{
    public function execute($id, $data)
    {
        $post = Post::find($id);
        $post->update($data);
        return $post;
    }
}