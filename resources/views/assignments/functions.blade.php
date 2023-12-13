@php
    function calculateAmountDone($logs, $exerciseId)
    {
        $exerciseLogs = $logs->where('exercise_id', $exerciseId);

        if ($exerciseLogs->isEmpty()) {
            return 0;
        }

        return $exerciseLogs->sum('sets');
    }

    function calculateProgress($logs, $exerciseId, $amount)
    {
        $totalSets = calculateAmountDone($logs, $exerciseId);
        $amountDone = $totalSets / $amount;
        return $amountDone > 0 ? round($amountDone * 100) : 0;
    }
    function getProgressBarWidth($assignment)
    {
        $logs = $assignment->workoutLogs;
        $totalProgress = 0;

        $exercises = $assignment->workoutPlan->exercises;

        // Filter logs to exclude those with null exercise values
        $logs = $logs->filter(function ($log) {
            return $log->exercise !== null;
        });

        foreach ($exercises as $exercise) {
            $progress = calculateProgress($logs, $exercise->id, $exercise->amount);
            $totalProgress += $progress;
        }

        $averageProgress = count($logs) > 0
            ? ($totalProgress / count($exercises))
            : 0;

        return round($averageProgress);
    }
@endphp
