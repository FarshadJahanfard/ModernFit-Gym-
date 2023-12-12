<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAssignmentAccess
{
    public function handle(Request $request, Closure $next)
    {
        $assignmentId = $request->route('assignmentId');
        $assignment = \App\Models\WorkoutAssignment::findOrFail($assignmentId);

        $user = Auth::user();

        if ($user->id == $assignment->member_id ||
            $user->id == $assignment->workoutPlan->user_id ||
            $user->hasRole('admin')
        ) {
            return $next($request);
        }

        abort(403, 'Forbidden action');
    }
}

