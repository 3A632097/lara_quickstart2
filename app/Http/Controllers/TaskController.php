<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
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
    public function create()
    {
        //
    }

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

    public function show(Task $task)
    {
        //
    }

    public function edit(Task $task)
    {
        //
    }

    public function update(Request $request, Task $task)
    {
        //
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
