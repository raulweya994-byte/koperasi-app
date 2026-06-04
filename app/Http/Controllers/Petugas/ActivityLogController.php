<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->orderBy('created_at', 'desc');

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('description', 'like', '%' . $request->search . '%')
                  ->orWhere('ip_address', 'like', '%' . $request->search . '%')
                  ->orWhere('user_agent', 'like', '%' . $request->search . '%');
            });
        }

        $logs = $query->paginate(20)->appends($request->query());

        // Get users for filter
        $users = \App\Models\User::whereIn('role', ['admin', 'petugas', 'pimpinan'])
                                 ->orderBy('name')
                                 ->get();

        // Get unique actions
        $actions = ActivityLog::select('action')
                             ->distinct()
                             ->orderBy('action')
                             ->pluck('action');

        return view('petugas.activity-log.index', compact('logs', 'users', 'actions'));
    }

    public function show($id)
    {
        $log = ActivityLog::with('user')->findOrFail($id);
        return view('petugas.activity-log.show', compact('log'));
    }

    public function destroy($id)
    {
        $log = ActivityLog::findOrFail($id);
        $log->delete();

        return redirect()->route('petugas.activity-log.index')
                       ->with('success', 'Log aktivitas berhasil dihapus!');
    }

    public function deleteAll(Request $request)
    {
        $count = ActivityLog::count();
        ActivityLog::truncate();

        return redirect()->route('petugas.activity-log.index')
                       ->with('success', "Semua log aktivitas ($count) berhasil dihapus!");
    }
}
