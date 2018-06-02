<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Answer;
use App\Score;
use App\Rating;

class RatingsController extends Controller
{

    private $points = 50;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($context, $context_id, $status, $post_id)
    {
        //Cria objeto de avaliação (Rating)
        $rating = new Rating();
        $rating->id_user = auth()->user()->id;
        $rating->id_context = $context_id;
        $rating->context = $context;
        $rating->status = $status;
        
        //Procura se o usuário já avaliou essa postagem ou resposta
        $check_rating = $rating->userAlreadyRated($rating);
        print_r($check_rating);
        
        if(sizeof($check_rating) == 0){
            //Se o usuário ainda não tinha avaliado, grava avaliação
            $rating->save();
            $rating->calculateScore($rating, $this->points);
        }else{
            //Se o usuário já tinha avaliado, deleta avaliação
            $rating::where('id', $check_rating[0]['id'])->delete();
            $rating->calculateScore($rating, $this->points, true);
            //Se o usuário avaliou com status diferente, grava nova avaliação
            if($check_rating[0]['status'] != $rating->status){
                $rating->save();
                $rating->calculateScore($rating, $this->points*3);
            } 
        }

        return redirect('/posts/' . $post_id)->with('success', $context.' avaliado com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
