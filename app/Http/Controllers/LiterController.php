<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Liter;
use App\Models\ProductLiter;
use Illuminate\Http\Request;

class LiterController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all=Liter::paginate(10);
        return view("admin.liters", ["liters"=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.literInsert");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        Liter::create(["liter"=>$request->input("liter")]);
        return redirect("/liter");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $role=Liter::find($id);
        $role->liter=$request->input("liter");
        $role->save();
        return back()->with("mess","Updated!")->with("alert", "alert-success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products=ProductLiter::where("liter_id", $id)->count();
        if($products==0){
            Liter::find($id)->delete();
            return back()->with("mess", "Measure is deleted." )->with("alert", "alert-info");

        }
        else{
            return back()->with("mess", "This mesaure cant be deleted. Products are conected with it." )->with("alert", "alert-danger");
        }
    }
}
