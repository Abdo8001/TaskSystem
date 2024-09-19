<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Image;
use App\Jobs\SendTask;
use Illuminate\Http\Request;
use App\Http\Traits\FileUploadTriat;
use Illuminate\Support\Facades\Auth;
use Request as recoo;

class TasksController extends Controller
{
    use FileUploadTriat;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      //  dd($request->task_name);
     //   dd(recoo::get('task_name'));
       if(empty(recoo::get('task_name'))){

        $tasks=Task::all();
        $users=User::all();
       }else{
        if(!empty(recoo::get('task_name'))){
        $tasks=Task::search(recoo::get('task_name'))->get();
      //  dd($tasks);
        $users=User::all();
        }if(!empty(recoo::get('created_at'))){
            $tasks=Task::search(recoo::get('created_at'));
            $users=User::all();
        }

    }
    //dd($users);
    return view('dashboard.tasks.index',['tasks'=>$tasks,'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request);
        $request->validate([
            'task_name'=>'required',

        ]);
       // dd($request->user_id);
        //$ids= str_split(str_replace(',', '', $request->user_id));

       
       // $user_emails=User::whereIn('id',$id)->get('email');
        foreach($request->user_id as $user){
            $task=Task::create([
                'task_name'=>$request->task_name,
                'manger_id'=>Auth::user()->id,
                'user_id'=>$user ,
            ]);
        }
        
        if($request->hasFile('tasks')){
        foreach($request->file('tasks') as $file){
            $name=$file->getClientOriginalName();
            $file->storeAs('attachments/tasks/'.$task->id,$name,'upload_attachments');
         $image=new Image();
         $image->filename=$name;
         $image->imageable_id=$task->id;
         $image->imageable_type='App\Models\Task';
         $image->save();

        
        }
    $users=$request->user_id;
        
    SendTask::dispatch($users);
        }
     //   $task->user()->attach($request->user_id);
        session()->flash('add',trans('messages.success'));
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
      $task=Task::where('user_id',Auth::user()->id)->findOrFail($id);
      //Task::where('id',$id)->where('user_id',Auth::user()->id)->get();
      $users=User::findOrFail(Auth::user()->id);
    // $users->tasks->where('user_id',$i)->findOrFail($id);
     // dd($users);

       return view('dashboard.tasks.show',['task'=>$task,'users'=>$users]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $tasks)
    {
// dd(Auth::user()->user_type);
        if(Auth::user()->user_type==1){
            
        //    dd($request);
            $request->validate([
                'status'=>'required',
    
            ]);
            Task::where('id',$request->id)->update([
                'status'=>$request->status,
            ]);   
            session()->flash('edit',trans('messages.success'));
            return  redirect()->back();  

        }else{
        $request->validate([
            'task_name'=>'required',

        ]);

        Task::where('id',$request->id)->update([
            'task_name'=>$request->task_name,
            'user_id'=>Auth::user()->id,
        ]);    
        session()->flash('edit',trans('messages.success'));
        return redirect()->route('tasks.index');  
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    { 
        Task::where('id',$id)->delete();

        session()->flash('add',trans('messages.success'));
        return redirect()->route('tasks.index');
    }

    public function dawnloadTask($img_name,$task_id){
        
        return response()->download(public_path('attachments/tasks/'.$img_name.'/'.$task_id));

   }

   public function taskUser (Request $request){
    $request->validate([
        'status'=>'required',

    ]);
    Task::where('id',$request->id)->update([
        'status'=>$request->status,
    ]);   
    session()->flash('edit',trans('messages.success'));
    return  redirect()->back(); 
   }
public function taskSearch(Request $request){
   // $search_task=Task::searchTask();
   //dd($request->query('task_name'));
   //dd($request);
   $tasks=Task::search($request->task_name);

     dd($tasks);

}

}
