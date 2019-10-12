<?php

namespace App\Http\Controllers;

use App\Post;
use App\SectionsPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($categoryId)
    {
        $categoryType = DB::table('categories')->where('id', $categoryId)->first()->type;
        if ($categoryType == 1) { //Ordine alfabetico A-Z
            $posts = DB::table('posts')->where('category', $categoryId)->orderBy('title', 'asc')->get();
        } else if ($categoryType == 2) { //Ordine dal più recente
            $posts = DB::table('posts')->where('category', $categoryId)->orderBy('date', 'desc')->get();
        } else if ($categoryType == 3) { //Ordine dal più vecchio
            $posts = DB::table('posts')->where('category', $categoryId)->orderBy('date', 'asc')->get();
        }

        $category = DB::table('categories')->where('id', $categoryId)->first();

        return view('pages', ['posts' => $posts, 'categoryType' => $categoryType, 'categoryId' => $categoryId, 'category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $categoryId)
    {
        $currentDate = Carbon\Carbon::now();
        $post = new Post();
        $post->title = $request->get('title');
        $post->category = $categoryId;
        $post->date = $currentDate->toDateTimeString();
        $post->author = \Auth::user()->name;
        $post->save();

        $savedPostId = DB::table('posts')->orderBy('id', 'desc')->first()->id;
        $sections = DB::table('sections')->where('category', $categoryId)->get();

        foreach ($sections as $section) {
            $newSectionBody = new SectionsPosts();
            $newSectionBody->body = '';
            $newSectionBody->section = $section->id;
            $newSectionBody->post = $savedPostId;
            $newSectionBody->save();
        }


        return redirect('/postEdit/' . $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = DB::table('posts')->where('id', $id)->get()->first();
        $category = DB::table('categories')->where('id', $posts->category)->get()->first();
        $sections = DB::table('sections')->where('category', $category->id)->get();
        $sections_post = DB::table('sections_posts')->where('post', $posts->id)->get();

        //dd($posts, $category, $sections, $sections_post);

        return view('post', ['posts' => $posts, 'category' => $category, 'sections' => $sections, 'sections_post' => $sections_post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = DB::table('posts')->where('id', $id)->get()->first();
        $category = DB::table('categories')->where('id', $posts->category)->get()->first();
        $sections = DB::table('sections')->where('category', $category->id)->get();
        $sections_post = DB::table('sections_posts')->where('post', $posts->id)->get();

        //dd($posts, $category, $sections, $sections_post);

        return view('postEditor', ['posts' => $posts, 'category' => $category, 'sections' => $sections, 'sections_post' => $sections_post]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $post->delete();
        return back();
    }

    public function save(Request $request)
    {
        $post = Post::find($request->get('postTitleID'));
        $post->title = $request->get('postTitle');
        $post->author = \Auth::user()->name;
        $currentDate = Carbon\Carbon::now();
        $post->date = $currentDate->toDateTimeString();
        $post->save();

        $id = $request->get('postId');
        foreach ($request->get('sections') as $section) {
            $section_post = SectionsPosts::find($section['id']);
            if($section['body'] == null){
                $section_post->body = "";
            }else{
                $section_post->body = $section['body'];
            }
            $section_post->save();
        }
        return redirect('/post/' . $id);
    }
}