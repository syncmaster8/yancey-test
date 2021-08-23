<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_Type;
use App\Models\Store;
use App\Models\Visitor;

class StoreController extends Controller
{
    public function read($store_id)
    {
        $type_id = auth()->user()->type_id;

        if($type_id != 3) return response()->json(['User is not a Shop Owner!']);

        $visitors = Visitor::where('store_entered_id',$store_id)->get();

        if(!$visitors){
            return response()->json(['visitors' => 'No Store Visitors data currently']);
        }

        return response()->json(['visitors' => $visitors]);
    }
}
