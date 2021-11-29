<?php

namespace App\Http\Controllers;

use App\Models\note;
use Illuminate\Http\Request;

class noteController extends Controller
{

    public function notes(){
        $notes = note::get();
        if (count($notes) != 0) {
            return response()->json(['success'=>$notes],200);
        } else {
            return response()->json(['error'=>'No Notes Added'],202);
        }
        
    }

    public function create(Request $request){
        
        if (note::create($request->all())) {
            return response()->json(['success'=>'Note Added'],200);
        } else {
            return response()->json(['error'=>'Something went wrong'],202);
        }
        
    }

    public function update(Request $request){
        $note = note::find($request->note_id);
        $note->name = $request->name;
        $note->email = $request->email;
        $note->note = $request->note;
        
        if ($note->save()) {
            return response()->json(['success'=>'Note Updated'],200);
        } else {
            return response()->json(['error'=>'Something went wrong'],202);
        }
        
    }

    public function delete($id){
        $note = note::find($id);

        if ($note->delete()) {
            return response()->json(['success'=>'Note Deleted'],200);
        } else {
            return response()->json(['error'=>'Something went wrong'],202);
        }
    }
}
