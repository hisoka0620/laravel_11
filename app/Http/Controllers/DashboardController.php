<?php

namespace App\Http\Controllers;

use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $now = now();
        $tomorrow = $now->copy()->addDay();

        $baseQuery = Task::where('user_id', $userId);

        $tasks = $baseQuery->clone()->orderBy('due_date', 'asc')->get();

        $ongoingTasks = $baseQuery->clone()->ongoingTasks()->get();

        $completedCount = $baseQuery->clone()->where('status', '=', 'completed')->count();

        $expiredCount = $baseQuery->clone()->where('due_date', '<', $now)->where('status', '!=', 'completed')->count();

        $unfinishedCount = $baseQuery->clone()->ongoingTasks()->count();

        $urgentTasksCount = $baseQuery->clone()->ongoingTasks()->where('due_date', '<', $tomorrow)->count();

        return view(
            'auth.dashboard',
            compact(
                'tasks',
                'unfinishedCount',
                'urgentTasksCount',
                'expiredCount',
                'completedCount',
                'ongoingTasks',
            )
        );
    }
}
