<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::with('category', 'user')
            ->select('id', 'user_id','category_id','title','status')
            ->orderByDesc('id')
            ->paginate(10);
        return view('backend.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::select('id', 'name')->get();
        return view('backend.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request;
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'status' => 'required|between:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = $request->file('thumbnail_path');
        $image_name = rand(11111, 99999) . '_' . $image->getClientOriginalName();
        $photo_image = 'post_image/';
        Image::make($image)->save($photo_image . $image_name);

        $post = new Post();
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->user_id = auth()->user()->id;
        $post->content = $request->post_content;
        $post->status = $request->status;
        $post->thumbnail_path = $photo_image . $image_name;
        $post->save();
        session()->flash('message', 'Category Post Successfully');
        session()->flash('type', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('category', 'user')->where('id', $id)->first();
//        return $post;
        return view('backend.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.post.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
            'status' => 'required|between:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = str_slug(trim($request->name));
        $category->status = $request->status;
        $category->save();
        session()->flash('message', 'Category Updated Successfully');
        session()->flash('type', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('message', 'Category Deleted Successfully');
        session()->flash('type', 'success');
        return redirect()->back();
    }
}
