<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function getDrops($id = null)
    {

        $drops = DB::table('drops')
            ->join('backdrops', 'drops.id', '=', 'backdrops.id_drops')
            ->get();

        return response()->json($drops);
    }
}
