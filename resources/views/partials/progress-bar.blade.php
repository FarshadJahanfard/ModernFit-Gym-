@php
    $progressBarWidth = getProgressBarWidth($assignment);
@endphp
<div class="progress ml-3 mt-1">
    <div class="progress-bar" role="progressbar" style="width: {{ $progressBarWidth }}%;" aria-valuenow="{{ $progressBarWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
</div>
