<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $tomorrow = Carbon::now()->addDay();

        $tasks = Task::where('user_id', auth()->id())->where('due_date', '>=', $now)->orderBy('due_date', 'asc')->get();

        $unfinishedCount = Task::where('user_id', auth()->id())->where('status', '!=', 'completed')->where('due_date', '>=', $now)->count();

        $urgentTasksCount = Task::where('user_id', auth()->id())->where('due_date', '>=', $now)->where('due_date', '<=', $tomorrow)->where('status', '!=', 'completed')->count();

        return view('auth.dashboard', compact('tasks', 'unfinishedCount', 'urgentTasksCount', 'now', 'tomorrow'));
    }
}
