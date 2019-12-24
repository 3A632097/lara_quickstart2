<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //return view('tasks.index');

        //顯示已有的任務
        $tasks = Task::where('user_id', $request->user()->id)->get();
        /*認證->使用者->任務*/                  // auth()->user()代表登入者的User model
        //$tasks= auth()->user()->tasks;
        /*認證->使用者->任務->get*/
        //$tasks= auth()->user()->tasks()->get();
        /*認證->使用者->任務*/           // auth()->user()等同於Auth::user()
        //$tasks=Auth::user()->tasks;
        /*認證->使用者->任務->get*/
        //$tasks=Auth::user()->tasks()->get();

        /*取得使用者相關資料或方法
        auth()->user()->id          //取得使用者的ID
        auth()->user()->name        //取得使用者的姓名
        auth()->user()->email       //取得使用者的mail
        auth()->user()->tasks       //登入後的使用者的所有任務
        auth()->user()->tasks()     //登入後的使用者與任務的1對多關係
        */

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // Create The Task...
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
    }
}
