<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class CityController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function searchCityZip(Request $request){
        $value=$request->input("value");
        $column=$request->input("column");
        $object=City::where($column,'like', '%'.$value.'%')->get();
        return json_encode($object);
    }

    public function indexJs()
    {
        $all=City::all();
        return json_encode($all);
    }

    public function index()
    {
        $all=City::paginate(10);
        return view("admin.cities", ["cities"=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.cityInsert");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        City::create(["name"=>$request->input("value"),
            "zipCode"=>$request->input("zip")]);
        return redirect("/city");
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
        $city=City::find($id);
        $city->name=$request->input("value");
//        $city->zipCode=$request->input("zip");
        $city->save();
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
        $products=User::where("city_id", $id)->count();
        if($products==0){
            City::find($id)->delete();
            return back()->with("mess", "City is deleted." )->with("alert", "alert-info" );

        }
        else{
            return back()->with("mess", "This city cant be deleted. Users are conected with it." )->with("alert", "alert-danger");
        }


    }
}
