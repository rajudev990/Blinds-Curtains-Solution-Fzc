<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use App\Models\BookingTime;
use App\Models\Book;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Route::get('cmd',function(){
//   Artisan::call("make:model InstallationReview -m");

    Artisan::call("storage:link");
    Artisan::call("route:clear");
    Artisan::call("view:clear");
    Artisan::call("cache:clear");
    Artisan::call("config:clear");
    Artisan::call("optimize:clear");
    return redirect()->route('home');
});



// Route::get('get-booking-time/{date}', function ($date) {
//     $date = Carbon::parse($date);
//     $available = [];
//     $times = BookingTime::all();
//     foreach($times as $time){
//         $total = Book::whereStatus(0)->whereBookingTimeId($time->id)->whereDate('booking_date',$date)->count();
//         if($total < 1){
//             $available[] = ['id' => $time->id,'name' => $time->name];
//         }
//     }
//     return response()->json($available);
// });




// Route::get('get-booking-time/{city}/{date}', function ($city, $date) {
//     try {
//         $date = Carbon::parse($date); // Parse the date
//         $available = [];
//         $times = BookingTime::all(); // Fetch all time slots

//         foreach ($times as $time) {
//             $total = Book::where('status', 0)
//                 ->where('booking_time_id', $time->id)
//                 ->where('city', $city) // Ensure city matches
//                 ->whereDate('booking_date', $date) // Ensure date matches
//                 ->count();

//             if ($total < 1) { // Check if the time slot is available
//                 $available[] = ['id' => $time->id, 'name' => $time->name];
//             }
//         }

//         return response()->json($available, 200);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Invalid Request'], 400);
//     }
// });




Route::get('get-booking-time/{city}/{date}', function ($city, $date) {
    try {
        // Convert date format from "09 March 2025" to "Y-m-d"
        $formattedDate = Carbon::createFromFormat('d F Y', $date)->format('Y-m-d');

        // Get current time
        $now = now();
        $currentMinutes = $now->hour * 60 + $now->minute;
        $nextAvailableMinutes = $currentMinutes + 60; // Allow only slots 1 hour later

        // Fetch booked slots for the selected city and date
        $bookedSlots = Book::where('city', $city)
            ->whereDate('booking_date', $formattedDate)
            ->pluck('booking_time_id') // Fetch only the time slot IDs
            ->toArray();

        // Define all possible time slots
        $allTimeSlots = [
            ['id' => 1, 'name' => '09:00 AM - 10:00 AM'],
            ['id' => 2, 'name' => '11:00 AM - 12:00 PM'],
            ['id' => 3, 'name' => '02:00 PM - 03:00 PM'],
            ['id' => 5, 'name' => '04:00 PM - 05:00 PM'],
            ['id' => 7, 'name' => '05:00 PM - 06:00 PM'],
            ['id' => 8, 'name' => '07:30 PM - 08:30 PM'],
            ['id' => 9, 'name' => '09:30 PM - 10:30 PM'],
        ];

        // Filter available slots
        $availableSlots = array_filter($allTimeSlots, function ($slot) use ($bookedSlots, $now, $nextAvailableMinutes, $formattedDate) {
            // Skip booked slots
            if (in_array($slot['id'], $bookedSlots)) {
                return false;
            }

            // If today's date, check for 1-hour restriction
            if ($formattedDate === $now->format('Y-m-d')) {
                $timeParts = explode(" - ", $slot['name']); // Split time range
                if (count($timeParts) < 1) return false;

                // Extract start time
                $startTime = Carbon::parse($timeParts[0]);

                // Convert start time to minutes
                $slotMinutes = $startTime->hour * 60 + $startTime->minute;

                return $slotMinutes >= $nextAvailableMinutes; // Only allow future slots
            }

            return true; // For future dates, show all slots
        });

        return response()->json([
            'available' => array_values($availableSlots), // Reset array keys
            'booked' => $bookedSlots
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid Request', 'message' => $e->getMessage()], 400);
    }
});



Route::get('/get-product-sizes/{product}', [WebsiteController::class, 'getProductSizes']);

// Route::get('/',function(){
//     return view('demohome');
// });

Route::get('/',[WebsiteController::class,'index'])->name('home');

Route::get('/offer-page-for-10-percent-discount',[WebsiteController::class,'offer'])->name('offer');
Route::post('/offer-save',[WebsiteController::class,'offerStore'])->name('offer-store');
Route::get('/thank-you',[WebsiteController::class,'thankyou'])->name('thankyou');

Route::get('/thank-you-for-booking',[WebsiteController::class,'bookConfirm'])->name('bookg-confirm');

Route::get('/our-products',[WebsiteController::class,'products'])->name('products');
Route::get('/product/{id?}',[WebsiteController::class,'productsSingle'])->name('product');

Route::get('/get-estimates',[WebsiteController::class,'estimates'])->name('estimates');

Route::get('/get-book-time-data/{id}', [WebsiteController::class, 'getBookTimeData']);

Route::get('get-unavailable-dates',[WebsiteController::class, 'getUnavailableDates']);

Route::get('/about-us',[WebsiteController::class,'aboutUs'])->name('about-us');
Route::get('/frequently-asked-questions',[WebsiteController::class,'help'])->name('help');
Route::get('/contact',[WebsiteController::class,'contact'])->name('contact');
Route::post('/contact',[WebsiteController::class,'contactSend'])->name('contact-send');
Route::get('/book',[WebsiteController::class,'book'])->name('book');
Route::get('/smart-curtains',[WebsiteController::class,'smartCurtains'])->name('smartCurtains');
Route::get('/privacy-policy',[WebsiteController::class,'privacy'])->name('privacy');
Route::get('/terms-condition',[WebsiteController::class,'terms'])->name('terms');
Route::get('/review',[WebsiteController::class,'review'])->name('review');
Route::get('/team',[WebsiteController::class,'team'])->name('team');

Route::get('/services',[WebsiteController::class,'allServices'])->name('services');
Route::get('/service/{id}',[WebsiteController::class,'singleService'])->name('service');
Route::post('/book-store',[WebsiteController::class,'bookStore'])->name('book.store');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
