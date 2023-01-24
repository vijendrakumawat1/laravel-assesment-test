<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
  
        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            
        ]);/*
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);*/
        $users= new User;
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->dob = $request->input('dob');
        $users->phone = $request->input('phone');
        $users->gender = $request->input('gender');
        $users->password = Hash::make($request->password);
        $users->save();
 
        return redirect()->route('users.index')
                        ->with('success','Product created successfully.');
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
        $users = User::find($id);
        return view ('users.edit',['users' =>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            
        ]);
         $users= User::find($request->id);
            $users->name=$request->name;
            $users->email = $request->email;
            $users->dob = $request->dob;
            $users->phone = $request->phone;
            $users->gender= $request->gender;
            $users->save();
        /*
        $users=User::find($request->get('$id'));
        $users->name = $request->get('name');
        $users->email = $request->get('email');
        $users->dob = $request->get('dob');
        $users->phone = $request->get('phone');
        $users->gender = $request->get('gender');
        $users->password = Hash::make($request->password);
        $users->save();*/
        return redirect()->route('users.index')
                        ->with('success','Product updated successfully.');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $users= User::find($request->id);
     $users->delete();
    return redirect('users.create');
    //if($result){
       // return ["result"=>"record has been deleted"];
     //}else{
        //return ["result"=>"record has been  not deleted"];
     
        
      

       // }
    
    }
}
