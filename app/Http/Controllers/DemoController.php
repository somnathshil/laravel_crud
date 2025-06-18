<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    public function first_demo(){
        echo "Hello World . This is laravel 10 ...";
    }

        public function signup_form():View{
        return view('form');
    }

      public function submit_form(Request $req){
        
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
        $fileName = time()."_".$file->getClientOriginalName();
        $uploadLocation = "./uploads";
        $file->move($uploadLocation,$fileName);
        $submitData = [
            'name'  => $name,
            'age'  => $age,
            'email'  => $email,
            'phone'  => $phone,
            'password'  => $password,
            'image'  => $uploadLocation."/".$fileName
        ];

      DB::table('laravel_demo')->insert($submitData);

       return redirect('/display');
    }


       public function display():View{
        $fetchData = DB::table('laravel_demo')->get();

        return view('display')->with(['allInfo'=>$fetchData]);
        }


         public function edit_form($edit_id){
            $editId = $edit_id;
        $editData = DB::table('laravel_demo')->where('user_id',$editId)->get()->first();

        return view('edit')->with(['editInfo'=>$editData]);
        }


         public function update(Request $req){

            $req->validate([
                'name' => "required|regex:/^[a-zA-Z ]{3,30}$/",
                'age' => "required|integer|between:18,40",
                'email' => "required|regex:/^[a-zA-Z0-9!#$%&?]+@[a-zA-Z0-9!#$%&?]+\.[a-zA-Z]{2,3}$/",
                'phone' => "required|regex:/^[6-9][0-9]{9,9}$/",
                'image' => "nullable|mimes:jpg,jpeg,webp,png,gif|max:4096"
            ]);


            $updateId = $req->input('updateId');
            $name = $req->input('name');
            $age = $req->input('age');
            $email = $req->input('email');
            $phone = $req->input('phone');

            $updateInfo = [
                'name' => $name,
                'age' => $age,
                'email' => $email,
                'phone' => $phone,
            ];

            if($req->file('image') && $req->file('image')->isValid()){

                $file = $req->file('image');
                $fieName = time() . "_" . $file->getClientOriginalName();
                $location = "./uploads";
                $file->move($location,$fieName);
                $updateInfo['image'] =  $location . "/" . $fieName;
            }
            
        $editData = DB::table('laravel_demo')->where('user_id',$updateId)->update($updateInfo);

        return redirect('/display');
        }



         public function delete($dlt_id){
            $deleteId = $dlt_id;
        $editData = DB::table('laravel_demo')->where('user_id',$deleteId)->delete();

       return redirect('/display');
        }

 }
       

