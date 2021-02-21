<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class PostLikeController
 * @package App\Http\Controllers
 */
class PostLikeController extends Controller
{
    /**
     * PostLikeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * @param Post $post
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Post $post, Request $request)
    {
        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);
        return back();
    }

    /**
     * @param Post $post
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
