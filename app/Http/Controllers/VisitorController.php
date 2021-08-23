<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_Type;
use App\Models\Store;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function read(Request $request)
    {
        $type_id = auth()->user()->type_id;

        if($type_id != 3) return response()->json(['User is not a Mall Manager!']);

        if($request->floor_number){
            $visitors = Visitor::where('floor_number',$request->floor_number)->get();
        }else {
            $visitors = Visitor::all();
        }

        if(!$visitors){
            return response()->json(['visitors' => 'No Visitors data currently']);
        }

        return response()->json(['visitors' => $visitors]);
    }
}
