<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DropController extends Controller
{
    public function index()
    {
        return view('/');
    }

    public function getDrop()
    {
        $id = 5;
        $filename = md5($id . microtime());

        dd($filename);
        return view('/');
    }
}
