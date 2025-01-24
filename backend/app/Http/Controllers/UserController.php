<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(){
        $lstUser= User::where('is_delete',"0")->orderBy('updated_at', 'desc')->paginate(5);

        return response()->json([
            'lstUser'=>$lstUser
        ]);
    }
    public function search(){
        $lstUser=User::where('is_delete',"0")->orderBy('updated_at', 'desc')->paginate(5);
        return response()->json([
            'message'=>'Edit Success',
            'lstUser'=>$lstUser
        ],200);
    }
    public function storeAdd(Request $request){

        $user=new User();
        $user->name=$request->fullname;
        $user->email=$request->email;
        $user->password=Hash::make('123456');

        $user->save();

        return response()->json([
            'message' => 'Add Success',
            'status' => 'success',
        ]);
    }

    public function storeEdit(Request $request,$id='') {
        if($id==''){
            $id=$request->id;
        }
        $user=User::find($id);
        $user->name=$request->fullname;
        $user->email=$request->email;
        $user->save();
        return response()->json([
            'message'=>'Edit Success',
            'status' => 'success',
            'user'=>$user
        ],200);
    }

    public function storeDelete($id) {

        $user=User::find($id);
        $user->is_delete=1;
        $user->save();
        return response()->json([
            'message'=>'Delete Success',
            'status' => 'success',
            'user'=>$user
        ],200);
    }
}
