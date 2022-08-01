<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=Category::paginate(10);
        return view("admin.categories", ["categories"=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categoryInsert");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        Category::create(["name"=>$request->input("value")]);
        return redirect("/category");
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
        $role=Category::find($id);
        $role->name=$request->input("value");
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

        $products=Product::where("category_id", $id)->count();
        if($products==0){
            Category::find($id)->delete();
            return back()->with("mess", "Category is deleted." )->with("alert", "alert-info" );

        }
        else{
            return back()->with("mess", "This category cant be deleted. Products are conected with it." )->with("alert", "alert-danger");
        }



    }
}
