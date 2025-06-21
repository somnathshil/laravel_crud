<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    public function first_demo()
    {
        echo "Hello World . This is laravel 10 ...";
    }

    public function signup_form(): View
    {
        return view('form');
    }

    public function submit_form(Request $req)
    {

        // print_r($req->all());
        // dd($req->all());


        $req->validate(
            [
                'name' => "required|regex:/^[A-Za-z ]{3,30}$/",
                'age' => "required|integer|between:18,40",
                'email' => "required|regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/",
                'phone' => "required|regex:/^[6-9][0-9]{9}$/",
                'password' => "required|regex: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/",
                'image' => "required|mimes:jpg,jpeg,png,gif,webp|max:4096"   //kb
            ]
        );




        $name = $req->input('name');
        $age = $req->input('age');
        $email = $req->input('email');
        $phone = $req->input('phone');
        $password = $req->input('password');
        $file = $req->file('image');
        $fileName = time() . "_" . $file->getClientOriginalName();
        $uploadLocation = "./uploads";
        $file->move($uploadLocation, $fileName);
        $submitData = [
            'name'  => $name,
            'age'  => $age,
            'email'  => $email,
            'phone'  => $phone,
            'password'  => $password,
            'image'  => $uploadLocation . "/" . $fileName
        ];

        DB::table('laravel_demo')->insert($submitData);

        return redirect('/display');
    }


    public function display(): View
    {
        $userId = session()->get('session_id');
        $fetchData = DB::table('laravel_demo')->where('user_id',$userId)->get();

        return view('display')->with(['allInfo' => $fetchData]);
    }

    public function delete_form($del_id)
    {
        $delId = $del_id;
        $fetchData = DB::table('laravel_demo')->where('user_id', $delId)->delete();

        return redirect('/login');
    }


    public function edit_data($edit_id)
    {
        $editId = $edit_id;
        $editData = DB::table('laravel_demo')->where('user_id', $editId)->get()->first();
        return view('edit')->with(['editInfo' => $editData]);
    }

    public function update_data(Request $req)
    {
        $req->validate(
            [
                'name' => "required|regex:/^[A-Za-z ]{3,30}$/",
                'age' => "required|integer|between:18,40",
                'email' => "required|regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/",
                'phone' => "required|regex:/^[6-9][0-9]{9}$/",
                'image' => "nullable|mimes:jpg,jpeg,png,gif,webp|max:4096"   //kb
            ]
        );

        $userId = $req->input('editId');
        $name = $req->input('name');
        $age = $req->input('age');
        $email = $req->input('email');
        $phone = $req->input('phone');

        $submitData = [
            'name'  => $name,
            'age'  => $age,
            'email'  => $email,
            'phone'  => $phone
        ];
        if ($req->hasFile('image') && $req->file('image')->isValid()) {
            $file = $req->file('image');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $uploadLocation = "./uploads";
            $file->move($uploadLocation, $fileName);
            $submitData['image'] = $uploadLocation . "/" . $fileName;
        }

        DB::table('laravel_demo')->where('user_id', $userId)->update($submitData);
        return redirect('/display');
    }

    public function login_form()
    {
        return view('login');
    }

    public function login_data(Request $req){
        $emlOrPh = $req->input('emlOrPh');
        $password = $req->input('password');
          $loginData = DB::table('laravel_demo')->where('email',$emlOrPh)
                                               ->orWhere('phone',$emlOrPh)
                                               ->get()
                                               ->first();
        if(empty($loginData)){
            return redirect('/login')->with('message','User not found');
        }else{
           $fetchPass = $loginData->password;
           if($fetchPass == $password){
            $userId = $loginData->user_id;
            $req->session()->put('session_id',$userId);
            return redirect('/display')->with('message','Logged in successfully !');
           }else{
            return redirect('/login')->with('message','Password not matching !');
           }
        }
    }


    public function change_pass(){
        return view('changePass');
    }

    public function change_pass_act(Request $req){
         $userId = session()->get('session_id');
        $fetchData = DB::table('laravel_demo')->where('user_id',$userId)
                                              ->get()
                                              ->first();
        $dbPass = $fetchData->password;
          $oldPass = $req->input('oldPass');                                    
          $newPass = $req->input('newPass');                                    
          $conPass = $req->input('conPass');                                    
          if($dbPass == $oldPass){
              if($oldPass != $newPass){
                 if($newPass == $conPass){
                   DB::table('laravel_demo')->where('user_id',$userId)
                                              ->update(['password'=>$conPass]);
                  return redirect('/display')->with('message','Password updated  successfully !');                            
                 }else{
                    return redirect('/changepass')->with('message','New and confirm password not ,matching !');
                 }
              }else{
                return redirect('/changepass')->with('message','Old and new password are same !');
              }
          }else{
            return redirect('/changepass')->with('message','Old password not matching !');
          }
    }

}
