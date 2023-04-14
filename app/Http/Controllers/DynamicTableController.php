<?php

namespace App\Http\Controllers;

use App\Models\DynamicTable;
use Illuminate\Http\Request;

class DynamicTableController extends Controller
{
    public function index()
    {
        $slots = DynamicTable::all();
        return view('task_2.index', compact('slots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "inputvalue" => "numeric|gt:0"
        ]);
        if ($request->input('inputColumn') == "input_1") {
            $input_1 = $request->input('inputvalue');
        }elseif ($request->input('inputColumn') == "input_2") {
            $input_2 = $request->input('inputvalue');
        }elseif ($request->input('inputColumn') == "input_3") {
            $input_3 = $request->input('inputvalue');
        }
        $slotExists = DynamicTable::where('slot', $request->slot)->first();
        if (is_null($slotExists)) {
            $slotExists = new DynamicTable();
            $slotExists->slot = $request->slot;
            if ($request->input('inputColumn') == "input_1") {
                $slotExists->input_1 = $request->input('inputvalue');
            }elseif ($request->input('inputColumn') == "input_2") {
                $slotExists->input_2 = $request->input('inputvalue');
            }elseif ($request->input('inputColumn') == "input_3") {
                $slotExists->input_3 = $request->input('inputvalue');
            }
            // $slotExists->save();
            // return response()->json(["success"=>true]);
        }else{
            if ($request->input('inputColumn') == "input_1") {
                $slotExists->input_1 = $request->input('inputvalue');
            }elseif ($request->input('inputColumn') == "input_2") {
                $slotExists->input_2 = $request->input('inputvalue');
            }elseif ($request->input('inputColumn') == "input_3") {
                $slotExists->input_3 = $request->input('inputvalue');
            }
            // $slotExists->save();
            // return response()->json(["success"=>true]);
        }
         $slotExists->save();
        return response()->json(["success"=>true]); 
    }
}
