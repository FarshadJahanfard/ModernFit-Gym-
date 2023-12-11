@php
    function calculateAmountDone($logs, $exerciseId, $amount)
    {
        $exerciseLogs = $logs->where('exercise_id', $exerciseId);

        if ($exerciseLogs->isEmpty()) {
            return 0;
        }

        return $exerciseLogs->sum('sets');
    }

    function calculateProgress($logs, $exerciseId, $amount)
    {
        $totalSets = calculateAmountDone($logs, $exerciseId, $amount);
        $amountDone = $totalSets / $amount;
        return $amountDone > 0 ? round($amountDone * 100, 2) : 0;
    }
@endphp
