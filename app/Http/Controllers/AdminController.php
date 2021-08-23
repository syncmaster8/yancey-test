<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_Type;
use App\Models\Store;
use App\Models\Visitor;

class AdminController extends Controller
{
    public function create(Request $request)
    {
        try{
            $type_id = auth()->user()->type_id;

            if($type_id != 1) return response()->json(['User is not a Super Admin!']);

            $validator = Validator::make($request->all(), [
                'name'      => 'string|required',
                'username'  => 'string|required|unique:users',
                'password'  => 'string|required|min:8',
                'type_id'   => 'numeric|required|in:'  . implode(',', ['1','2','3']),
                'store_id'  => 'numeric|nullable'
            ]);

            if ($validator->fails()) {
                return response()->json(['Requirements' => $validator->errors()]);
            }

            \DB::beginTransaction();

            $user = User::create([
                'name'      => $request->name,
                'username'  => $request->username,
                'password'  => bcrypt($request->password),
                'type_id'   => $request->type_id,
                'store_id'  => $request->store_id
            ]);

            \DB::commit();

            return response()->json(['User has been created' => $user]);

        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['Error']);
        }
    }

    public function read()
    {
        $type_id = auth()->user()->type_id;

        if($type_id != 1) return response()->json(['User is not a Super Admin!']);

        $users = User::all();

        if(!$users){
           return response()->json(['No Users currently']);
        }

        return response()->json(['Users' => $users]);
    }
    
    public function update(Request $request, $user_id)
    {
        try{
            $type_id = auth()->user()->type_id;

            if($type_id != 1) return response()->json(['User is not a Super Admin!']);

            $validator = Validator::make($request->all(), [
                'name'      => 'string',
                'username'  => 'string|unique:users',
                'password'  => 'string|min:8',
                'type_id'   => 'numeric|in:'  . implode(',', ['1','2','3']),
                'store_id'  => 'numeric|nullable'
            ]);

            if ($validator->fails()) {
                return response()->json(['Requirements' => $validator->errors()]);
            }

            \DB::beginTransaction();

            $user = User::findOrFail($user_id);

            if($request->name){
                $user->name = $request->name;
            }

            if($request->username){
                $user->username = $request->username;
            }

            if($request->password){
                $user->password = bcrypt($request->password);
            }

            if($request->type_id){
                $user->type_id = $request->type_id;
            }

            if($request->store_id){
                $user->store_id = $request->store_id;
            }

            $user->save();

            \DB::commit();

            return response()->json(['User has been updated' => $user]);

        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['Error']);
        }
    }

    public function delete($id)
    {
        try{
            $type_id = auth()->user()->type_id;

            if($type_id != 1) return response()->json(['User is not a Super Admin!']);

            \DB::beginTransaction();

            $user = User::findOrFail($id);

            $user->delete();

            \DB::commit();

            return response()->json(['User has been deleted' => $user]);

        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['Error']);
        }
    }

}
