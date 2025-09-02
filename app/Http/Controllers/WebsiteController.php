<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Mail\ConfirmationBookkingAdmin;
use App\Mail\ContactFormMail;
use App\Mail\ConfirmationBookkingCustomer;
use App\Models\Baner;
use App\Models\Book;
use App\Models\BookingTime;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\ChooseCurtain;
use App\Models\DifferentFabric;
use App\Models\EstimateList;
use App\Models\Happyclient;
use App\Models\Hero;
use App\Models\OurBlog;
use App\Models\Ourteam;
use App\Models\Product;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\WhyKurtains;
use Illuminate\Http\Request;
use App\Models\AboutUsPage;
use App\Models\ElectricCurtain;
use App\Models\FurtherGo;
use App\Models\Help;
use App\Models\HelpTitle;
use App\Models\LifeStyle;
use App\Models\SmartCurtainsMedia;
use App\Models\SmartCurtainsPage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendBookingEmail;
use App\Models\Subscriber;

class WebsiteController extends Controller
{
    public function index()
    {
        $pageTitle = Setting::first()->website_name;
        $banners = Baner::where('status',1)->latest()->get();
        $heros = Hero::first();
        $services = Service::where('status',1)->latest()->get();
        $estimate_lists = EstimateList::where('status',1)->get();
        $clients = Happyclient::where('status',1)->get();

        $bestsallers = Product::where('featured_status',1)->get();

        // $categories = Category::with('products')->where('status',1)->get();
        
        $categories = Category::with(['products' => function($query) {
            $query->where('status', 1); // Filter active products
        }])
        ->where('status', 1)               // Filter active categories
        ->where('name', '!=', 'Accessories') // Exclude "Accessories" category
        ->get();


        return view('website.index',compact('banners','heros','services','estimate_lists','clients','pageTitle','bestsallers','categories'));
    }
    
    public function getBookTimeData($id)
    {
        $bookTime = BookingTime::find($id); // Replace with your model and relation
    
        if ($bookTime) {
            return response()->json([
                'time_slot' => $bookTime->name,
            ]);
        }
    
        return response()->json(['error' => 'Time slot not found'], 404);
    }

    // offer pages
    public function offer()
    {
        $pageTitle = Setting::first()->website_name;
        $banners = Baner::where('status',1)->latest()->get();
        $heros = Hero::first();
        $services = Service::where('status',1)->latest()->get();
        $estimate_lists = EstimateList::where('status',1)->get();
        $clients = Happyclient::where('status',1)->get();

        $bestsallers = Product::where('featured_status', 1)
                      ->orderBy('created_at', 'asc') // or 'desc' for latest first
                      ->take(4)
                      ->get();

        $categories = Category::with('products')->where('status',1)->get();
        return view('website.offer',compact('banners','heros','services','estimate_lists','clients','pageTitle','bestsallers','categories'));
    }

    public function offerStore(Request $request)
    {
        $code = rand(111111, 999999);

        Subscriber::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'code' => $code,
            'discount' => 10,
        ]);

        // Store the code in the session
        session()->put('offer_code', $code);
        session()->put('name', $request->name);
        session()->put('email', $request->email);
        session()->put('phone', $request->phone);
      

        $notification = array(
            'message' => 'Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('thankyou')->with($notification);
    }

    public function thankyou()
    {
        $pageTitle = Setting::first()->website_name;
        $offerCode = session()->get('offer_code'); // Retrieve the code from the session

        return view('website.thank-you', compact('pageTitle', 'offerCode'));
    }


    public function allServices()
    {
        $services = Service::where('status',1)->get();
        return view('website.services',compact('services'));
    }

    public function singleService($id)
    {
        $service = Service::findOrFail($id);
        $services = Service::where('status',1)->get();
        return view('website.service-single',compact('service','services'));
    }

    public function products()
    {
        $data = Product::with('sizes')->whereStatus(1)->latest()->get();
        $category = Category::whereStatus(1)->latest()->get();
        return view('website.products',compact('data','category'));

    }

    public function productsSingle($id)
    {
        $data = Product::whereStatus(1)->findOrFail($id);
        $bestsallers = Product::where('featured_status',1)->get();
        $services = Service::where('status',1)->get();
        $choose = ChooseCurtain::whereStatus(1)->latest()->get();
        $ourBlog = OurBlog::whereStatus(1)->latest()->get();
        return view('website.product',compact('data','bestsallers','services','choose','ourBlog'));
    }


    public function estimates()
    {
        // $data = Product::with('sizes')->where('estimate_status',1)->whereStatus(1)->latest()->get();
        $ourBlog = OurBlog::whereStatus(1)->latest()->get();
        $choose = ChooseCurtain::whereStatus(1)->latest()->get();
        $different  = DifferentFabric::whereStatus(1)->latest()->get();
        $why  = WhyKurtains::whereStatus(1)->latest()->get();
        $service  = Service::whereStatus(1)->latest()->get();


        // if (request()->product_id) {
        //     $selected = Product::whereStatus(1)->findOrFail(request()->product_id);
        // } else {
        //     $selected = isset($data[0]) ? $data[0] : null;
        // }
        return view('website.estimates', compact('ourBlog', 'choose', 'different', 'why', 'service'));

    }
    
    // ProductController.php
    public function getProductSizes(Product $product)
    {
        return response()->json([
            'sizes' => $product->sizes->map(function($size) {
                return [
                    'width' => $size->width,
                    'height' => $size->height,
                    'price' => $size->price,
                ];
            })
        ]);
    }

    // Function to fetch unavailable dates
    public function getUnavailableDates(Request $request)
    {
        $city = $request->input('city'); // Fetch the selected city

        if (!$city) {
            return response()->json([], 400); // Return an error if city is not provided
        }

        // Fetch dates where all time slots are booked for the specified city
        $bookedDates = Book::select('booking_date')
            ->where('city', $city) // Filter by city
            ->groupBy('booking_date')
            ->havingRaw('COUNT(DISTINCT booking_time_id) = (SELECT COUNT(*) FROM booking_times)')
            ->pluck('booking_date');

        // Return booked dates as an array in the response
        return response()->json($bookedDates);
    }



    public function book()
    {   
        $pageTitle = Setting::first()->website_name;
        $disabledDate = [];
        $bookedDate = Book::distinct()->groupBy('booking_date')->pluck('booking_date')->toArray();
        $times = BookingTime::all();
        foreach($bookedDate as $date){
            foreach($times as $time){
                $total = Book::whereStatus(0)->whereBookingTimeId($time->id)->whereDate('booking_date',$date)->count();
                if($total > 1){
                    $booked = true;
                }else{
                    $booked = false;
                }
            }
            if($booked){
                $disabledDate[] = $date->format('j-n-Y');
            }
        }
        return view('website.book',compact('disabledDate','pageTitle'));
    }



    // Book store
    public function bookStore(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'booking_date' => 'required',
            'city' => 'required',
            'booking_time_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'address' => 'required|string|max:255',
            'flat_no' => 'nullable|string|max:255',
            'windows_number' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ],
        [
            'booking_time_id.required' => 'Please select a booking time.',
        ]);
        
        // Parse the booking date to Carbon instance
        $validatedData['booking_date'] = Carbon::parse($request->booking_date);
        $validatedData['status'] = 'pending';
        $validatedData['book_id'] = rand(1111, 9999);
        
        // Determine the calendar based on the selected city
        if ($request->city == 'Dubai') {
            $calendar = '1'; // Assign to calendar 1 for Dubai
        } elseif ($request->city == 'Abu Dhabi') {
            $calendar = '2'; // Assign to calendar 2 for Abu Dhabi
        } else {
            // Default or error handling for other cities
            $calendar = '1'; // Or return an error if the city is unexpected
        }
        
        // Check if there's already a booking with the same booking_date, booking_time_id, and city
        $existingBooking = Book::where('booking_date', $validatedData['booking_date'])
            ->where('booking_time_id', $validatedData['booking_time_id'])
            ->where('city', $request->city) // Check for the city as well
            ->where('calendar', $calendar) // Check for the assigned calendar
            ->first();

        if (!$existingBooking) {
            $validatedData['calendar'] = $calendar; // Assign the determined calendar
            $validatedData['city'] = $request->city; // Store the city
            // Create the booking record
            $bookDatas = Book::create($validatedData);

            // Send email user
            $userMail = $request->email;
            $datas    = Setting::first();
            $data     = $datas->toArray();
            $data['book_id'] = $bookDatas->book_id;
            $data['name'] = $bookDatas->name;
            $data['booking_date'] = $bookDatas->booking_date;
            $data['booking_time_id'] = $bookDatas->bookingTime->name;
            Mail::to($userMail)->send(new ConfirmationBookkingCustomer($data));

            // Send email admin
            $adminMail  = 'admin@curtainssolutions.com';
            $adminDatas = Setting::first();
            $adminData = $adminDatas->toArray();
            $bookData  = $bookDatas->toArray();
            $bookData['booking_time_id'] = $bookDatas->bookingTime->name ?? 'N/A';
            $newAdminData = array_merge($adminData, $bookData);
            Mail::to($adminMail)->send(new ConfirmationBookkingAdmin($newAdminData));
            
            // SendBookingEmail::dispatch($userMail, $data, $adminMail, $newAdminData)->delay(now()->addMinutes(1));
            
            
            // Prepare AiSensy API payload
            $phoneNumber = $request->phone; 
            $name = $request->name;
            $bookId = $bookDatas->book_id;
            
            $bookDate = $bookDatas->booking_date;
            $formattedDate = date('Y-m-d', strtotime($bookDate));
            $bookTime = $bookDatas->bookingTime->name;
            
            
            $data = [
                "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                "campaignName" => "step_one",
                "destination" => $phoneNumber,
                "userName" => "Blinds & Curtains Solution Fzc",
                "templateParams" => [
                    "$name",
                    "$bookId",
                    "$formattedDate",
                    "$bookTime"
                ],
                "source" => "new-landing-page form",
                "media" => [],
                "buttons" =>[],
                "carouselCards" => [],
                "location" => [],
                "paramsFallbackValue" => [
                    "FirstName" => '$name'
                ]
            ];
        
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $data);
        
            if ($response->successful()) {
                $notification = array(
                    'message' => 'Booking Confirmed Successfully!',
                    'alert-type' => 'success'
                );
            } else {
                \Log::error('AiSensy WhatsApp API failed', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
        
                $notification = array(
                    'message' => 'Booking Confirmed Successfully',
                    'alert-type' => 'success'
                );
            }
        
            // return redirect()->back()->with($notification);
            return redirect()->route('bookg-confirm')->with('bookingData', $bookDatas);
        } else {
            // If booking already exists in the same calendar for the selected date and time
            $notification = array(
                'message' => 'This time slot is already booked in the selected calendar for the city.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        
    }
    
    public function bookConfirm()
    {

        // Retrieve the booking data from the session
        $pageTitle = Setting::first()->website_name;
        $bookingData = session('bookingData');
    
        // Check if booking data is null, meaning the page is reloaded without valid session data
        if (!$bookingData) {
            return redirect()->route('book')->with('message', 'Your booking data has expired. Please book again.'); // Adjust the route name as necessary
        }
    
        return view('website.book-thank-you', compact('bookingData', 'pageTitle'));
    
    
    }
    
    

    public function smartCurtains()
    {
        $categories = Category::where('status',1)->get();
        $go_furthers = FurtherGo::where('status',1)->get();
        $lifes = LifeStyle::where('status',1)->get();
        $medias = SmartCurtainsMedia::where('status',1)->get();
        $electrics = ElectricCurtain::where('status',1)->get();
        $page = SmartCurtainsPage::first();
        return view('website.smartcurtains',compact('categories','go_furthers','lifes','medias','electrics','page'));
    }

    public function aboutUs()
    {
        $pageTitle = Setting::first()->website_name;
        $teams = Ourteam::where('status',1)->get();
        $services = Service::where('status',1)->latest()->get();
        $page = Page::where('slug','about-us')->first();
        $aboutus = AboutUsPage::first();
        return view('website.about-us',compact('pageTitle','teams','services','page','aboutus'));
    }
    public function contact()
    {
        $page = Setting::first();
        return view('website.contact',compact('page'));
    }

    public function contactSend(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
        ]);

        $contact = ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Send email to admin
        Mail::to('admin@curtainssolutions.com')->send(new ContactFormMail($contact));


        $notification = array(
            'message' => 'Contact Send Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }



    public function help()
    {
        $data = Help::where('status',1)->get();
        $help_title = HelpTitle::where('status',1)->get();
        return view('website.help',compact('data','help_title'));
    }
    public function review()
    {
        return view('website.review');
    }
    public function team()
    {
        $pageTitle = Setting::first()->website_name;
        $teams = Ourteam::where('status',1)->get();
        return view('website.team',compact('teams','pageTitle'));
    }

    public function terms()
    {
        $pageTitle = Setting::first()->website_name;
        $page = Page::where('slug','terms-condition')->first();
        return view('website.terms',compact('page','pageTitle'));
    }

    public function privacy()
    {
        $pageTitle = Setting::first()->website_name;
        $page = Page::where('slug','privacy-policy')->first();
        return view('website.terms',compact('page','pageTitle'));
    }

    


}
