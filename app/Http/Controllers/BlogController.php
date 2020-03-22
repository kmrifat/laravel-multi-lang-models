<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogTranslation;
use App\Helpers\LocalizationHelper;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('blogs.index', [
            'blogs' => Blog::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogRequest $request)
    {
        $blog = new Blog();
        $blog->user_id = auth()->user()->id;
        if ($blog->save()) {
            $blogTranslation = new BlogTranslation();
            $blogTranslation->blog_id = $blog->id;
            $blogTranslation->fill($request->all());
            $blogTranslation->save();
            return redirect()->route('blog.edit', [$blog, 'lang' => $request->lang])->with('success', 'Blog Has Benn Saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Blog $blog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Blog $blog)
    {
        return view('blogs.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Blog $blog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', [
            'blog' => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Blog $blog)
    {
        $blogTranslation = BlogTranslation::where('blog_id', $blog->id)->where('lang', $request->lang)->first();
        if (!is_object($blogTranslation)) {
            $blogTranslation = new BlogTranslation();
            $blogTranslation->blog_id = $blog->id;
        }
        $blogTranslation->fill($request->all());
        $blogTranslation->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
