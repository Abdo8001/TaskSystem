<?php
namespace App\Http\Traits;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;


trait GurdedNameTriat
{
public function getGurdedName($request){
    if($request->type=='admin'){

       $gurded_name='manger';
    }
    else{
        $gurded_name='web';

    }
    return $gurded_name;

}
public function redirect_To($request){
    if($request->type=='admin'){
       // return redirect()->route('Classrooms.index');
        return redirect()->route('tasks.index');
       //  return redirect()->intended(RouteServiceProvider::STUDENT);

     }
     else{
     //   dd(Auth::user()->user_type);
        // $tasks=;
        // dd($tasks);
        return  redirect()->route('dashboard');
     //   return view('home',['tasks'=>$tasks]) ;

      ///  return redirect()->intended(RouteServiceProvider::HOME);

     }


}

}

