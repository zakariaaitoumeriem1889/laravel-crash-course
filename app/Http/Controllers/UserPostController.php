<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class UserPostController
 * @package App\Http\Controllers
 */
class UserPostController extends Controller
{
    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function index(User $user)
    {
        $posts = $user->posts()->with(['user', 'likes'])->paginate(20);
        return view('users.posts.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
