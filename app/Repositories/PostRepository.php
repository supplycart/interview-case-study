<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use App\Models\Post;

class PostRepository extends BaseRepository
{
    public function model()
    {
        return Post::class;
    }
    
    public function ban($post_id){
        $post = Post::find($post_id);

        if($post->is_ban){
            $post->update(['is_ban' => 0]);
            $message = 'Post is Unbanned!';
        }else{
            $post->update(['is_ban' => 1]);
            $message = 'Post is Banned!';
        }

        return $message;
    }

    public function highlight($post_id){
        $post = Post::find($post_id);

        if($post->is_highlight){
            $post->update(['is_highlight' => 0]);
            $message = 'Remove Post Highlight !';
        }else{
            $post->update(['is_highlight' => 1]);
            $message = 'Post is Highlight!';
        }

        return $message;
    }
}
