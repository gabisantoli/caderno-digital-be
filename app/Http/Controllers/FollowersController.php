<?php

namespace App\Http\Controllers;

use App\User;
use App\Follower;
use Illuminate\Support\Facades\DB;

class FollowersController extends Controller
{

    private $table = "followers";

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
    public function store($id_follower, $id_post)
    {
        $follower = new Follower();
        $follower->follower_id = $id_follower;
        $follower->user_id = auth()->user()->id;
        $follower->save();

        return redirect('/posts/' . $id_post)->with('success', 'Follower created!');
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
