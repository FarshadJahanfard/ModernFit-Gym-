@php
    function calculateCalories($logs)
    {
        return $logs->sum('calories');
    }
    function calculateCaloriesProgress($logs, $amount)
    {
        $totalAmount = calculateCalories($logs);
        $progressPercentage = ($totalAmount / $amount) * 100;

        return $progressPercentage;
    }
@endphp
