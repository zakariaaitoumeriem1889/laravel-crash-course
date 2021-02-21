<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
        return view('posts.index');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        dd('ok');
    }
}
