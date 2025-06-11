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

        $baseQuery = Task::where('user_id', $userId);

        $tasks = $baseQuery->clone()->orderBy('due_date', 'asc')->get();

        $ongoingTasks = $baseQuery->clone()->where(function ($query) use ($now) {
            $query->where('due_date', '>=', $now)->orWhereNull('due_date');
        });

        $completedCount = $baseQuery->clone()->where('status', '=', 'completed')->count();

        $expiredCount = $baseQuery->clone()->where('due_date', '<', $now)->where('status', '!=', 'completed')->count();

        $unfinishedCount = $ongoingTasks->clone()->where('status', '!=', 'completed')->count();

        $urgentTasksCount = $ongoingTasks->clone()->where('due_date', '<', $tomorrow)->where('status', '!=', 'completed')->count();

        return view('auth.dashboard', compact('tasks', 'unfinishedCount', 'urgentTasksCount', 'expiredCount', 'completedCount', 'now'));
    }
}
