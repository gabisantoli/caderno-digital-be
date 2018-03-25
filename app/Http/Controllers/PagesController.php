<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }
    public function about(){
        $data['title'] = "About page";
        return view('pages.about')->with($data);
    }

    public function services(){
        $data['title'] = 'Services Page';
        $data['services'] = ['Web Design', 'Programming', 'SEO', 'Hardware'];

        return view('pages.services')->with($data);
    }
}
