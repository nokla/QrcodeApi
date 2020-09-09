<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function index(){
        $users = User::all();
        
        return response()->json($users);
    }

    public function create(Request $request){
        $code = \QrCode::size(500)
        ->format('png')
        ->generate('ItSolutionStuff.com', base_path('public/images/qrcode.png'));
    }
}
