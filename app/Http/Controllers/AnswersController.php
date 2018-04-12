<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Answer;

class AnswersController extends Controller
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
        $answers = Answer::orderBy('created_at', 'desc')->paginate(10);
        return view('answers.index')->with('answers', $answers);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('answers.create');
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
            'text' => 'required',
        ]);
        return redirect('/answers')->with('success', 'Answer created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer = Answer::find($id);
        $user = User::find($answer->user_id);
        
        return view('answers.show')
            ->with('answer', $answer)
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $answer = Answer::find($id);
        
        //Check for correct user
        if(auth()->user()->id !== $answer->user_id){
            return redirect('/answers')->with('error', 'Unauthorized page');
        }
        return view('answers.edit')->with('answer', $answer);
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
            'text' => 'required',
        ]);

        $answer = Answer::find($id);
        $answer->text = $request->input('text');

        $answer->save();

        return redirect('/answers')->with('success', 'Answer Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::find($id);
        $user_answer = User::find($answer->user_id);

        if(auth()->user()->id !== $answer->user_id && auth()->user()->type == $user_answer->type){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        //Verifica se o Usuário é aluno e se a resposta é de um professor
        if(auth()->user()->type == 0 && $user_answer->type == 1){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        $answer->delete();
        
        return redirect('/posts')->with('success', 'Answer deleted!');
    }
}
