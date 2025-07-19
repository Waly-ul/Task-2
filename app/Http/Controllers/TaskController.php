<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(Task::where('user_id', auth()->id())->get());
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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $user = JWTAuth::parseToken()->authenticate();
        
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'user_id' => $user->id,
        ]);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorizeTask($task);

        return new TaskResource($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);
        $task->update($request->only(['title', 'description', 'status', 'due_date']));
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }

    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    }
}
