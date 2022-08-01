<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserInsertRequest;
use App\Models\City;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;


class Auth extends MyController
{

public function __construct()
{
    parent::__construct();
    $this->middleware('LoginMiddlware')->only('index');
}

    public function login(LoginRequest $request){
    $user=User::where([
        ["email", $request->email],
        ["password", md5($request->password)]])->first();
    if($user){
    $request->session()->put("user",$user);
    $request->session()->put("cart", ["user_id"=>$request->session()->get("user")->id, "products"=>[]]);
        $text = $request->ip()."\t".$request->url()."\t".$request->method()."\t".$user->email."\t"."Logged in"."\t".date("Y-m-d H:i:s");
        $write = new User();
        $write->log($text);
        return json_encode(['status'=>true,"url"=>url('/')]);
    }
    else{
        return json_encode(['status'=>false,'mess'=>"Email and password dosen't exist in database."]);

    }
    }
public function logout(Request $request){
    $email = $request->session()->get("user")->email;
    $text = $request->ip()."\t".$request->url()."\t".$request->method()."\t".$email."\t"."Logged out"."\t".date("Y-m-d H:i:s");
    $write = new User();
    $write->log($text);

    $request->session()->forget("user");
    $request->session()->forget("cart");

    return redirect()->back();
}
    public function index()
    {
        return view("site.login",["url"=>"login","menu"=>$this->menu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("site.registration",["url"=>"registration", "menu"=>$this->menu]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserInsertRequest $request)
    {
        $validated=$request->validated();
        $image=$request->file('picture');
        $newName = time() . $image->getClientOriginalName();
        $validated['picture']=$newName;
        $validated['password']=md5($validated['password']);
//
        $insert=User::create($validated);
        if($insert){
            $image->move(public_path() . '/assets/images/users/', $newName);
            return json_encode(['status'=>true,"url"=>url('auth')]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        dd($id);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
