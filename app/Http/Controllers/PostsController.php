<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //Pra deletar imagens quando deleta o post
use App\Post;

class PostsController extends Controller
{/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')){
            //Get fileName with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
             
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            //Get file Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //FIlename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //Upload
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
        
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
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
        
        //Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        //Handle file upload - Copiado do create, dá pra fazer um método privado
        if($request->hasFile('cover_image')){
            //Get fileName with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
             
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            //Get file Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //FIlename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //Upload
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if($request->hasFile('cover_image')){
            //Deleta imagem antiga e adiciona nova somente se não for o noimage
            if($post->cover_image != 'noimage.jpg'){
                //Delete image
                Storage::delete('/public/cover_images/' . $post->cover_image);
            }            
            //Salvar somente se tiver enviado a imagem
            $post->cover_image = $fileNameToStore;
        }

        $post->save();

        return redirect('/posts')->with('success', 'Post Updated successfully!');
        
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

        //Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        if($post->cover_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('/public/cover_images/' . $post->cover_image);
        }

        $post->delete();
        
        return redirect('/posts')->with('success', 'Post deleted!');
    }
}
