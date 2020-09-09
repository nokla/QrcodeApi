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
        $user = User::create($request->all());
        $filename = 'images/'.$user->id.'_'.strtotime(date("Y-m-d H:i:s")).'.png';

        $code = \QrCode::size(500)
        ->format('png')
        ->generate($user->id, base_path('public/'.$filename));
        $user->qrcode=$filename;
        $user->update();
        return response()->json($filename);
    }

    public function show(Int $id){
        $user = User::find($id);
        if (!$user) {
            return '';
        }
        return response()->json($user);
    }

    public function update(Request $request,$id){
        $user = User::find($id);
        if (!$user) {
            return '';
        }
        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($id){
        $user = User::find($id);
        if (!$user) {
            return '';
        }
        $user->delete();
        return 'OK';
    }
}
