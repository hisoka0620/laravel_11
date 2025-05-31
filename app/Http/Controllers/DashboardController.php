<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $now = Carbon::now();
        $tomorrow = $now->copy()->addDay();

        $baseQuery = Task::where('user_id', $userId)->where('due_date', '>=', $now);

        $tasks = $baseQuery->clone()->orderBy('due_date', 'asc')->get();

        $unfinishedCount = $baseQuery->clone()->where('status', '!=', 'completed')->count();

        $urgentTasksCount = $baseQuery->clone()->where('due_date', '<=', $tomorrow)->where('status', '!=', 'completed')->count();

        return view('auth.dashboard', compact('tasks', 'unfinishedCount', 'urgentTasksCount'));
    }
}
