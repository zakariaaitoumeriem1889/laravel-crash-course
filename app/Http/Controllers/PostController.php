<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::latest()->with(['user', 'likes'])->paginate(20);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $request->user()->posts()->create($request->only('body'));
        return back();
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}
