<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index()
    {
        $lstUser = User::where('is_delete', "0")->orderBy('updated_at', 'desc')->paginate(5);

        return response()->json([
            'lstUser' => $lstUser
        ]);
    }
    public function search(Request $request)
    {
        $lstUser = User::where('is_delete', '0')->where(function ($q) use ($request) {
            $q->when($request->filled('name'), function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            })->when($request->filled('email'), function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            })->when($request->filled('is_activeSearch'), function ($q) use ($request) {
                $q->where('is_active', $request->is_activeSearch);
            });
        })->orderBy('updated_at', 'desc')->paginate(5);
        return response()->json([
            'lstUser' => $lstUser
        ], 200);
    }
    public function storeAdd(Request $request)
    {

        $messages = [
            'fullname.required' => 'Enter your name',

            'email.required' => "Email can't empty",
            'email.email' => "Email must be email",
            'email.unique' => 'Email has been register',
        ];
        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required|email|unique:Users,email',
        ], $messages);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make('123456');

        $user->save();

        return response()->json([
            'message' => 'Add Success',
            'status' => 'success',
        ]);
    }

    public function storeEdit(Request $request, $id = '')
    {
        if ($id == '') {
            $id = $request->id;
        }

        $messages = [
            'fullname.required' => 'Enter your name',
        ];
        $this->validate($request, [
            'fullname' => 'required',
        ], $messages);

        $user = User::find($id);
        $user->name = $request->fullname;
        $user->is_active = $request->is_active;
        $user->save();
        return response()->json([
            'message' => 'Edit Success',
            'status' => 'success',
            'user' => $user
        ], 200);
    }

    public function storeDelete($id)
    {

        $user = User::find($id);
        $user->is_delete = 0;
        $user->save();
        return response()->json([
            'message' => 'Delete Success',
            'status' => 'success',
            'user' => $user
        ], 200);
    }
}
