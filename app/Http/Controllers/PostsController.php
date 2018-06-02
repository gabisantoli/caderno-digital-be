<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //Pra deletar imagens quando deleta o post
use App\Post;
use App\User;
use App\Answer;
use App\Score;
use App\Rating;

class PostsController extends Controller{

    private $points = 500;

    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function getApi(){
        return Post::all();
    }

    public function index(){
        //$posts = Post::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
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

        $score = new Score();
        $score->updateScore($post->user_id, $this->points);

        return redirect('/posts')->with('success', 'Post criado!');
    }

    public function show($id){
        $post = Post::find($id);
        $user = User::find($post->user_id);
        $answers = Answer::where('post_id', $id)->orderBy('created_at', 'asc')->get();
        $rating = new Rating();

        if (Auth::check()) {
            foreach ($answers as $answer) {
                $answer->user = User::find($answer->user_id);
                
                $answer->avaliacoes_positivas = $rating->getRatingFromContext($answer->id, 'answer')['positivo'];
                $answer->avaliacoes_negativas = $rating->getRatingFromContext($answer->id, 'answer')['negativo'];
                
                $rating_answer = new Rating();
                $rating_answer->id_user = auth()->user()->id;
                $rating_answer->id_context = $id;
                $rating_answer->context = 'answer';
                $voto_usuario_answer = $rating->userAlreadyRated($rating_answer);

                if(sizeof($voto_usuario_answer) != 0){
            
                    if($voto_usuario_answer[0]['status'] == "positivo"){
                        $answer->flag_voto_usuario['positivo_css'] = "voto-positivo";
                    }
        
                    if($voto_usuario_answer[0]['status'] == "negativo"){
                        $answer->flag_voto_usuario['negativo_css'] = "voto-negativo";
                    }
                        
                }

                if (auth()->user()->id == $answer->user_id) {
                    $answer->button = array(
                        'delete' => true,
                        'edit' => true
                    );
                }

                if (auth()->user()->type == 1 && $answer->user->type == 0) {
                    $answer->button = array(
                        'delete' => true,
                        'edit' => false,
                    );
                }
            }
        }
        
        $post->avaliacoes_positivas = $rating->getRatingFromContext($id, 'post')['positivo'];
        $post->avaliacoes_negativas = $rating->getRatingFromContext($id, 'post')['negativo'];
        
        $rating_post = new Rating();
        $rating_post->id_user = auth()->user()->id;
        $rating_post->id_context = $id;
        $rating_post->context = 'post';
        $voto_usuario = $rating->userAlreadyRated($rating_post);

        if(sizeof($voto_usuario) != 0){
            
            if($voto_usuario[0]['status'] == "positivo"){
                $post->flag_voto_usuario['positivo_css'] = "voto-positivo";
            }

            if($voto_usuario[0]['status'] == "negativo"){
                $post->flag_voto_usuario['negativo_css'] = "voto-negativo";
            }
                
        }

        return view('posts.show')
            ->with('post', $post)
            ->with('user', $user)
            ->with('answers', $answers);
    }

    public function edit($id){
        $post = Post::find($id);

        //Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Não autorizado');
        }
        return view('posts.edit')->with('post', $post);
    }

    public function update(Request $request, $id){
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

        return redirect('/posts')->with('success', 'Post atualizado com sucesso!');

    }

    public function destroy($id){
        $post = Post::find($id);
        $user_post = User::find($post->user_id);

        if(auth()->user()->id !== $post->user_id && auth()->user()->type == $user_post->type){
            return redirect('/posts')->with('error', 'Sem autorização');
        }

        //Verifica se o Usuário é aluno e se a postagem é de um professor
        if(auth()->user()->type == 0 && $user_post->type == 1){
            throw new Exception();
        }

        if($post->cover_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('/public/cover_images/' . $post->cover_image);
        }

        $score = new Score();
        $score->updateScore($post->user_id, $this->points, false);

        $post->delete();

        return redirect('/posts')->with('success', 'Post deletado!');
    }
}
