<?php

namespace App\Http\Controllers;

use Auth;

use App\Tag;

use App\Post;

use App\Category;

use Session;

use Illuminate\Http\Request;



if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class PostsController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $categories = Category::all();

        $tags = Tag::all();


        if($categories->count() == 0 || $tags->count() == 0)

        {

            Session::flash('info', 'You Must Have Some Categories and Tags before attemping to create a Post');
            return redirect()->back();


        }

        return view('admin.posts.create')->with('categories', $categories)
                                         ->with('tags', $tags);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

           'title'          =>  'required',

           'featured'       =>  'required|image',

           'content'        =>  'required',

           'category_id'    =>  'required',

           'tags'           =>  'required'

           'user_id'  =>  Auth::id()


        ]);

        $featured = $request->featured;

        $featured_new_name = time().$featured->getClientOriginalName();

        $featured->move('uploads/posts', $featured_new_name);


        $post = Post::create([

             'title'         =>  $request->title,

             'content'      =>  $request->content,

             'featured'     =>   'uploads/posts/' . $featured_new_name,

             'category_id'  =>  $request->category_id,

             'slug'         =>  str_slug($request->title),




        ]);

        $post->tags()->attach($request->tags);

        Session::flash('success', 'You Successfully  Created the Post.');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);


        return view('admin.posts.edit')->with('post', $post)
                                       ->with('categories', Category::all())
                                       ->with('tags', Tag::all());


         


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

        $post = Post::find($id);





        $this->validate($request, [

            'title'   => 'required',


            'content'  =>  'required',


            'category_id'  =>  'required'



        ]);


        


        if($request->hasFile('featured'))

        {

            $featured = $request->featured;

            $featured_new_name = time() . $featured->getClientOriginalName();

            $featured->move('uploads/posts', $featured_new_name);

            $post->featured = 'uploads/posts/'.$featured_new_name;


        }

        $post->title = $request->title;

        $post->content= $request->content;

        $post->category_id = $request->category_id;

        $post->save();

        $post->tags()->sync($request->tags);

        Session::flash('success', 'Post updated successfully.');

        return redirect()->route('posts');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post != null) {


        $post->delete();

    }

        Session::flash('success', 'The post was just trashed.');

        return redirect()->back();


    }

    public function trashed() {

        $posts = Post::onlyTrashed()->get();

        

        return view('admin.posts.trashed')->with('posts', $posts);


    }


    public function kill($id) {


        $post = Post::withTrashed()->where('id', $id)->first();

        $post->forceDelete();


        Session::flash('success', 'Post deleted permanently.');


        return redirect()->back();



    }

    public function restore($id) 
    {


        $post = Post::withTrashed()->where('id', $id)->first();


        $post->restore();

        Session::flash('success', 'Post restored successfully.');


        return redirect()->route('posts');
    }
}
