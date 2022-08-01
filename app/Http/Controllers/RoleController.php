<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=Role::paginate(10);
        return view("admin.roles", ["roles"=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.roleInsert");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        Role::create(["name"=>$request->input("value")]);
        return redirect("/role");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $role=Role::find($id);
        $role->name=$request->input("value");
        $role->save();
        return back()->with("mess","Updated!")->with("alert", "alert-success");
//        dd($request->input("value"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products=User::where("role_id", $id)->count();
        if($products==0){
            Role::find($id)->delete();
            return back()->with("mess", "Role is deleted." )->with("alert", "alert-info");

        }
        else{
            return back()->with("mess", "This role cant be deleted. Users are conected with it." )->with("alert", "alert-danger");
        }

    }
}
