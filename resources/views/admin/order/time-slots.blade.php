{{-- @if(count($timeSlots) > 0)
    <div class="time-slot-container">
        @foreach($timeSlots as $slot)
            <button type="button" class="time-slot btn btn-outline-primary mb-2" data-time="{{ $slot['start'] }}">
                {{ $slot['start'] }} - {{ $slot['end'] }}
            </button>
        @endforeach
    </div>
@else
    <p>No available time slots for the selected date.</p>
@endif --}}


@if(count($timeSlots) > 0)
    <div class="time-slot-container">
    @foreach($timeSlots as $slot)
        
            <button type="button" class="time-slot-btn btn btn-outline-primary mb-1" data-time="{{ $slot['start'] }} - {{ $slot['end'] }}">
                {{ $slot['start'] }} - {{ $slot['end'] }}
            </button>
        
    @endforeach
    </div>
@else
    <p class="text-danger">No available time slots.</p>
@endif