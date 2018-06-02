<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit')
        ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request,[
            'email' => 'required',
            'name' => 'required|min:5|max:35',
            'newpass' => 'nullable|min:3|max:20',
            'confirmpass' => 'nullable|min:3|max:20|same:newpass',
        ],[
            'email.required' => 'O email deve ser preenchido',
            'name.required' => ' O nome deve ser preenchido',
            'confirmpass.same' => 'Senhas não conferem'
        ]);
        $user = auth()->user();
        //Handle file upload
        if($request->input('newpass') != null){
            $newpass = $request->input('newpass');
            $confirmpass = $request->input('confirmpass');
            $currentpass = $request->input('currentpass');
            
            if(!Hash::check($currentpass, $user->password)){
                return Redirect::back()->withErrors(['Senha atual não está correta']);
            }  
            if(Hash::check($newpass, $user->password)){
                return Redirect::back()->withErrors(['Você deve digitar uma senha diferente da atual']);
            }
            $user->password = Hash::make($newpass);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect('/profile')->with('success', 'Alterado com sucesso!');
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
