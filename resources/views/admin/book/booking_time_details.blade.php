<!-- Display the selected date -->
@if($bookTimes->isEmpty())
<tr>
    <td colspan="5" class="text-center">No booking times available for the selected date.</td>
</tr>
@else
@foreach($bookTimes as $bookTime)
@php
$book = $bookTime->books->first(); // Get the first related book for this book_time_id
@endphp
<tr>
    <td>
        <strong>{{ $bookTime->name }}</strong> <br>
        <strong>{{ $date }}</strong>
    </td>
    @if($book)
    <!-- If a booking exists for this time -->
    <td>
        {{ $book->name }} <br>
        {{ $book->email }} <br>
        {{ $book->phone }}
    </td>
    <td>
        {{ $book->address }} <br>
        {{ $book->flat_no }} <br>
        {{ $book->windows_number }} <br>
        {{ $book->type }} <br>
        {{ $book->comment }}
    </td>
    <td>
        
        @if($book->status=='failed')
        <span class="text-capitalize">{{ $book->status }}</span> <br>
        <span class="text-danger">{{ $book->reason }}</span>
        @else
            {{ $book->status }}
        @endif
    
    </td>
    <td>
        <div class="btn-group">
            <button style="background-color: #982f6a;border:#982f6a;" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                Action <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="{{ route('markDelivered', $book->id) }}">Delivered</a>
                <div class="dropdown-divider"></div>
                <!-- <a class="dropdown-item" href="{{ route('markFailed', $book->id) }}">Failed</a> -->
                <!-- Dropdown Item for Failed -->
                <a class="dropdown-item mark-failed-btn" href="#" data-id="{{ $book->id }}">Failed</a>
                <div class="dropdown-divider"></div>
            </div>
        </div>

        <style>
            .failed-reason {
                margin-top: 10px;
            }

            .failed-reason .form-control {
                margin-bottom: 10px;
            }
        </style>

        <!-- Input box for failure reason -->
        <div class="failed-reason" id="failed-reason-{{ $book->id }}" style="display: none;">
            <form id="failed-form-{{ $book->id }}" action="{{ route('markFailed') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                
                <div class="form-group">
                    <label for="reason-{{ $book->id }}">Reason for Failure:</label>
                    <input type="text" name="reason" id="reason-{{ $book->id }}" class="form-control" placeholder="Enter reason" required>
                </div>
                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>

    </td>
    @else
    <!-- If no booking exists for this time -->
    <td colspan="3" class="text-success">Available for booking</td>
    <td>
        <div class="btn-group">
            <button style="background-color: #982f6a;border:#982f6a;" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                Action <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
                <form action="{{ route('addBooking') }}" method="post">
                    @csrf
                    <input type="hidden" name="book_time" value="{{ $bookTime->id }}">
                    <input type="hidden" name="book_date" value="{{ $date }}">
                    <input type="hidden" name="calendar" value="1">
                    <input type="hidden" name="city" value="Dubai">
                    <button type="submit" class="dropdown-item">Add Booking</button>
                </form>
                <div class="dropdown-divider"></div>
                <form action="{{ route('blockBooking') }}" method="post">
                    @csrf
                    <input type="hidden" name="book_time" value="{{ $bookTime->id }}">
                    <input type="hidden" name="book_date" value="{{ $date }}">
                    <input type="hidden" name="calendar" value="1">
                    <input type="hidden" name="city" value="Dubai">
                    <button type="submit" class="dropdown-item">Block Booking</button>
                </form>
            </div>
        </div>
    </td>
    @endif
</tr>
@endforeach
@endif

<script>
    $(document).ready(function() {
        // When the "Failed" link is clicked
        $('.mark-failed-btn').on('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            
            // Get the book_id from the data attribute
            const bookId = $(this).data('id');

            // Show the corresponding failed reason div
            $('#failed-reason-' + bookId).css('display', 'block');
        });
    });
</script>