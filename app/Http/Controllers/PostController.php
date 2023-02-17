<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\Post;
use Illuminate\Support\Facades\Event;

class PostController extends Controller
{
    public function index()
    {
        $posts = cache('posts');
        return view('blog.index', ['posts' => $posts]);
    }

    public function add()
    {
        $post = Post::create([
            'user_id' => 1,
            'title' => 'Otwell',
            'description' => 'Developer',
        ]);
        $post->save();
        Event::dispatch(new PostCreated);
        return true;
    }
}
