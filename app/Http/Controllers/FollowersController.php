<?php

namespace App\Http\Controllers;

use App\User;
use App\Follower;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FollowersController extends Controller
{

    private $table = "followers";

    public function index()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function create($user_id) {
        $user = User::find($user_id);
        $btnLabel = 'Seguir';

//        verificar se usuário e follower são iguais
//        trocar link e label para unfollow se já estiver seguindo

        return view('followers.create')
            ->with('user', $user)
            ->with('label', $btnLabel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $follower = new Follower();
        $follower->follower_id = $request->input('follower_id');
        $follower->user_id = $request->input('user_id');
        $follower->save();

        return redirect('/posts/')->with('success', 'Follower created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $follower = Follower::find($id);
        $user = User::find($follower->user_id);

        return view('answers.show')
            ->with('follower', $follower)
            ->with('user', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $post_id)
    {
        DB::table($this->table)->where([
            ['user_id', auth()->user()->id],
            ['follower_id', $id],
        ])->delete();

        return redirect('/posts/' . $post_id)->with('success', 'Follower deleted!');
    }
}
