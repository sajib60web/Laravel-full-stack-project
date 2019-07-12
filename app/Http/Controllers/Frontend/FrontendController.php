<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Post;
use App\Http\Controllers\Controller;


class FrontendController extends Controller
{
    public function index()
    {
        $data['articles'] = cache('articles', function () {
            return Post::with('category', 'user')
                ->orderByDesc('created_at')
                ->take(100)->get();
        });
        return view('frontend.index', $data);
    }
}
