<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Follower;
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
        $following = DB::table('followers')
            ->where('user_id', $user_id)
            ->where('follower_id', auth()->user()->id)
            ->get();
        $followers = DB::table('followers')
            ->where('user_id', $user_id)
            ->get();

        if (sizeof($following) > 0) {
            $btnLabel = 'Deixar de seguir';
            $action = 'FollowersController@destroy';
        } else {
            $btnLabel = 'Seguir';
            $action = 'FollowersController@store';
        }

        return view('followers.create')
            ->with('user', $user)
            ->with('label', $btnLabel)
            ->with('action', $action)
            ->with('followers', sizeof($followers));
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

        if ($follower->follower_id != $follower->user_id) {
            $follower->save();
        }

        return redirect('/followers/create/'. $follower->user_id)->with('success', 'Follower created!');
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
    public function destroy(Request $request)
    {
        $user_id = $request->input('user_id');
        DB::table($this->table)->where([
            ['user_id', $user_id],
            ['follower_id', auth()->user()->id],
        ])->delete();

        return redirect('/followers/create/' . $user_id)->with('success', 'Follower deleted!');
    }
}
