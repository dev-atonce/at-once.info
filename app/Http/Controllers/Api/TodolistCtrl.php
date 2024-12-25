<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TodolistCollection;

class TodolistCtrl extends Controller
{

    public function __construct()
    {
        $this->response = [
            'status' => false,
            'message' => 'An error occurred.'
        ];
    }
    public function get(Request $request,$id = null)
    {
        try{
            if($id)
            {
                $data = \App\Models\TodolistMd::where('id',$id)->first();
            }else{
                $data = \App\Models\TodolistMd::all();
            }
            return response()->json($data);
            // return TodolistCollection::collection($data);
            
        } catch (\Exception $e) {
            dd($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } 

    }

    public function updateChecklist(Request $request)
    {
        $res = [
            'status' => false,
            'message' => 'An error occurred.'
        ];

        $get = \App\Models\ChecklistMd::where('todoId',$request->todoId)->first();

        if(@$get->todoId)
        {
            $get = \App\Models\ChecklistMd::find($request->id);
            $get->title = $request->title ? $request->title : 'Title';
            if($get->save())
            {
                $res = [
                    'status' => true,
                    'message' => 'Data has been updated.'
                ];
            }
        }else{  
            $new = new \App\Models\ChecklistMd;
            $new->todoId = $request->todoId;
            if($new->save())
            {
                $res = [
                    'status' => true,
                    'message' => 'The data has been created.',
                    'id' => $new->id
                ];
            }
        }

        return response()->json($res);
    }

    public function updateChecklistItem(Request $request)
    {
        $res = [
            'status' => false,
            'message' => 'An error occurred.'
        ];
        $get = \App\Models\ChecklistItemMd::where('id',$request->id)->first();
        if(@$get->id)
        {
            if($request->title) $get->title = $request->title;
            $get->do = $request->do === true ? 1 : 0;
            if($get->save()){
                $res = [
                    'status' => true,
                    'message' => 'Data has been updated.'
                ];
            }
        }

        return response()->json($res);
    }

    public function storeChecklistItem(Request $request)
    {
        $res = [
            'status' => false,
            'message' => 'An error occurred.'
        ];

        $new = new \App\Models\ChecklistItemMd;
        $new->checklist = $request->checklist;
        $new->title = $request->title;
        if($new->save()){
            $res = [
                'status' => true,
                'message' => 'The data has been created.',
                'id' => $new->id
            ];
        }
        return response()->json($res);
    }

    function getMemberInTodolist(Request $request,$id)
    {
        $res = $this->response;

        $get = \App\Models\TodolistMd::find($id);
        if(@$get->id){
            $res = [];
            $members = json_decode($get->user);
            foreach(\App\Models\UsersMd::whereIn('id',$members)->get() as $k => $v){
                $res[] = [
                    'id' => $v->id,
                    'character' => substr($v->name,0,2),
                    'name' => $v->name
                ];
            }
        }
        return response()->json($res);
    }
    function updateMemberInTodolist(Request $request)
    {
        $res = [
            'status' => false,
            'message' => 'An error occurred.'
        ];

        $get = \App\Models\TodolistMd::find($request->todoId);
        if(@$get->id){
            $get->user = json_encode($request->user);
            if($get->save()){
                $res = [
                    'status' => true,
                    'message' => 'Data has been updated.'
                ];
            }
        }
        return response()->json($res);
    }
    public function updateMemberInTodolistAndReturn(Request $request)
    {
        $res = [
            'status' => false,
            'message' => 'An error occurred.'
        ];

        $get = \App\Models\TodolistMd::find($request->todoId);
        if(@$get->id){
            $get->user = json_encode($request->user);
            if ($get->save()) {
                $res = [];
                $members = json_decode($get->user);
                foreach(\App\Models\UsersMd::whereIn('id',$members)->get() as $k => $v){
                    $res[] = [
                        'id' => $v->id,
                        'character' => substr($v->name,0,2),
                        'name' => $v->name
                    ];
                }
            }
        }
        return response()->json($res);
    }

    public function deleteChecklistItem(Request $request)
    {
        $res = [
            'status' => false,
            'message' => 'An error occurred.',
            'id' => $request->id
        ];

        $get = \App\Models\ChecklistItemMd::find($request->id);
        if(@$get->id){
            $get->delete();
                $res = [
                    'status' => true,
                    'message' => 'Data has been deleted.'
                ];
            
        }
        return response()->json($res);
    }
}
