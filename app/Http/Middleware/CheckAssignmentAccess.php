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

        // Determine the type of assignment based on the URL segment
        $assignmentType = $request->segment(1); // Assumes the assignment type is the first segment

        // Use dynamic properties to access fields based on the assignment type
        switch ($assignmentType) {
            case 'workout':
                $assignment = \App\Models\WorkoutAssignment::findOrFail($assignmentId);
                $userId = $assignment->member_id;
                $trainerId = $assignment->workoutPlan->user_id;
                break;
            case 'diet':
                $assignment = \App\Models\DietAssignment::findOrFail($assignmentId);
                $userId = $assignment->user_id;
                $trainerId = $assignment->plan->trainer_id;
                break;
            default:
                abort(404, 'Assignment type not supported');
        }

        $user = Auth::user();

        // Check access based on user and trainer IDs
        if ($user->id == $userId || $user->id == $trainerId) {
            return $next($request);
        }

        abort(403, 'Forbidden action');
    }
}

