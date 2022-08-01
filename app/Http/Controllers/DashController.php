<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Cart;
use App\Models\Message;
use App\Models\Order;
use App\Models\ProductLiter;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashController extends MyController
{
    public function index(){
        $messages=Message::all();
        $cart=Cart::with('user')->get();
        $cartCount=Cart::all()->count();
        $productsSum=Order::all("quantity")->sum("quantity");
        $users=User::all()->count();
        return view("admin.dashboard", ["mess"=>$messages, "cart"=>$cart, "cartCount"=>$cartCount, "productsSum"=>$productsSum, "users"=>$users]);
    }
    public function deleteMess($id){
        $messages=Message::find($id);
        $messages->delete();
        return back()->with("mess","Message deleted!")->with("alert", "alert-info");
    }

    public function register($value, AdminRequest $request){
   $users=User::with('city', 'role')->where("created_at","LIKE" ,"$value%")->get();
   $roles=Role::all();


        return json_encode(["users"=>$users, "roles"=>$roles]);
    }

    public function removeFilter(){
        return redirect('user');
    }

    public function listLogInOut(){
        $content=null;
        if(Storage::disk("local")->exists("log.txt")){
            $content=Storage::get("log.txt");
            $content=explode("\r\n",$content);
                $newContent=[];
                foreach ($content as $item){
                    $newContent[]=explode("\t",$item);

                    foreach ($newContent as $n){
                        $user=User::with('role')->where("email", $n[3])->first();
                        $c[]=[$user->picture,$user->role->name,$n[0],$n[3],$n[4],$n[5]];
                    }

                $content=$c;
            }
        }
$roles=Role::all();

        return view("admin.register", ["log"=>$content,"roles"=>$roles]);
    }


    public function listLogInOutFilter(Request $request)
    {
        $date=$request->input("date");
        $role=$request->input("role");
        $log=$request->input("log");
        $content=null;
        $c=null;
        if(Storage::disk("local")->exists("log.txt")){
            $content=Storage::get("log.txt");
            $content=explode("\r\n",$content);
            $newContent=[];
            foreach ($content as $item){
                $newContent[]=explode("\t",$item);
                foreach ($newContent as $n){

                    $logDate=explode(" ",$n[5]);
                    $user=User::with('role')->where("email", $n[3])->first();



                    if($logDate[0]==$date && $role==0 ){
                        if($n[4]==$log){
                            $c[]=[$user->picture,$user->role->name,$n[0],$n[3],$n[4],$n[5]];
                        }
                        else if($log==0){
                            $c[]=[$user->picture,$user->role->name,$n[0],$n[3],$n[4],$n[5]];

                        }
                    }


                    else if($date==null  && $role==0 && $log==0){
                        $c[]=[$user->picture,$user->role->name,$n[0],$n[3],$n[4],$n[5]];
                    }



                    else if($date==null  && $role==0 && $log!=0){
                        if($n[4]==$log){
                            $c[]=[$user->picture,$user->role->name,$n[0],$n[3],$n[4],$n[5]];
                        }
                    }


                    else if($date==null  && $role!=0){
                        $user = User::with('role')->where("email", $n[3])->where("role_id", $role)->first();

                        if($n[4]==$log) {
                            if ($user == null) {
                            }
                            else {
                                $c[] = [$user->picture, $user->role->name, $n[0], $n[3], $n[4], $n[5]];
                            }
                        }
                        else if($log==0) {
                            if ($user == null) {
                            } else {
                                $c[] = [$user->picture, $user->role->name, $n[0], $n[3], $n[4], $n[5]];
                            }
                        }

                        }

                    else if($logDate[0]==$date  && $role!=0){
                        if($n[4]==$log) {

                            $user=User::with('role')->where("email", $n[3])->where("role_id",$role)->first();

                        if($user==null){
                        }
                        else{
                            $c[]=[$user->picture,$user->role->name,$n[0],$n[3],$n[4],$n[5]];
                        }
                        }
                        else if($log==0) {

                            $user=User::with('role')->where("email", $n[3])->where("role_id",$role)->first();

                            if($user==null){
                            }
                            else{
                                $c[]=[$user->picture,$user->role->name,$n[0],$n[3],$n[4],$n[5]];
                            }
                        }


                        }

                }
                $content=$c;

            }
        }

        return json_encode($c);


    }
    }
