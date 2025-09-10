<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Auth::user()
        ->todos()   
        ->orderBy('created_at', 'desc')
        ->get();

    return view('auth.todos', compact('todos'));
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
    public function store(StoreTodoRequest $request)
    {
        Auth::user()->todos()->create([
        'todo_name' => $request->todo_name,
    ]);
    
        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('auth.update', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        
        $todo->update([
            'todo_name' => $request->todo_name
        ]);
        
        return redirect()->route('todos.index');
    }


     public function startTiming(Todo $todo)
    {
        $now = Carbon::now();

        $todo->update([

            'start_date' => $now->format('Y-m-d'),
            'start_time' => $now->format('H:i:s'),
            'started' => $now,
            'reset' => null

        ]);
        
        return redirect()->route('todos.index');
    }

    public function endTiming(Todo $todo)
    {
        $now = Carbon::now();

        $duration = 0;

    if ($todo->started_at) {
        $duration = Carbon::parse($todo->started_at)->diffInMinutes($now);
    }

        $todo->update([

            'end_date' => $now->format('Y-m-d'),
            'end_time' => $now->format('H:i:s'),
            'ended_at' => $now,

        ]);
        
        return redirect()->route('todos.index');
    }

    public function reset(Todo $todo)
    {
        
    
        $todo->update([
            'reset' => '1',
            'start_date'=> null,
            'start_time'=> null,
            'end_date'=> null,
            'end_time'=> null,
            'started'=> null,
            'ended_at'=> null,
            'duration'=>null
        ]);
        
        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        

        $todo->delete();
        return redirect()->route('todos.index');
    }

    

    public function TimeDestroy(Todo $todo)
    {
        

        $todo->delete([
            'start_date',
            'start_time',
            'end_date',
            'end_time',
            'started',
            'ended_at'
        ]);

        return redirect()->route('todos.index');
    }

   public function open(){
    $todos = Auth::user()
        ->todos()
        ->whereNotNull('start_time')   
        ->whereNull('end_time')
        ->orderBy('start_time', 'desc')
        ->get();

    return view('auth.open', compact('todos'))->with('filter', 'open');

}
public function closed(){
    $todos = Auth::user()
        ->todos()
        ->whereNotNull('end_time')   
        ->orderBy('start_time', 'desc')
        ->get();

    return view('auth.closed', compact('todos'))->with('filter', 'closed');

}



}
