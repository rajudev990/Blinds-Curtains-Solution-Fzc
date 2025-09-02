<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\AttributesSize;
use App\Models\Category;
use App\Models\GalleryImage;
use App\Models\Product;
use App\Models\Catalogue;
use App\Models\CatalogueItem;
use App\Models\CatalougeBook;
use App\Models\PageNumber;
use App\Models\ProductCatalouge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::latest()->get();
        return view('admin.product.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::where('status',1)->latest()->get();
        $catalouge = Catalogue::where('status',1)->get();
        return view('admin.product.create',compact('category','catalouge'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            // 'gallery_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'title' => 'required',
            'short_description' => 'required',
            'price_rate' => 'required',
            'description' => '',
            'sku' => 'required|unique:products',
            'serial_number'     => 'nullable|unique:products',
            'catalogue_id' => 'nullable|array',  // Validate it's an array
            'catalogue_id.*' => 'exists:catalogues,id',  // Ensure each ID exists
            
          
        ]);

        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;
        $meta_image = $request->hasFile('meta_image') ? ImageHelper::uploadImage($request->file('meta_image')) : null;
        

        
        $product = Product::create([
            'image' => $image,
            'title' => $request->title,
            'slug' =>  Str::slug($request->title),
            'short_description' => $request->short_description,
            'price_rate' => $request->price_rate,
            'base_charge' => $request->base_charge,
            'additional_charge' => $request->additional_charge,
            'description' => $request->description,
            'cm_length' => $request->cm_length,
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'estimate_status' => $request->estimate_status,
            'featured_status' => $request->featured_status,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'meta_image' => $meta_image,
            'serial_number' => $request->serial_number,
            'number' => $request->number,
            'email' => $request->email,
            'smart_curtains' => $request->smart_curtains,
            'style' => $request->style,
        ]);



        if($request->catalogue_id) {
            foreach($request->catalogue_id as $id) {
                ProductCatalouge::create([
                    "product_id" => $product->id,
                    "catalogue_id" => $id  // Store each catalogue ID as a row
                ]);
            }
        }
  

        if($request->width)
        {
            foreach($request->width as $key=>$id){
                $attrSize = new AttributesSize;
                $attrSize->product_id = $product->id;
                $attrSize->width = $request->width[$key];
                $attrSize->height = $request->height[$key];
                $attrSize->price = $request->size_price[$key];
                $attrSize->save();
            }
        }
       


       if($request->hasFile('gallery_image')) {
            foreach ($request->file('gallery_image') as $image) {
                Log::info('Processing image: ' . $image->getClientOriginalName());
                $galleryImage = new GalleryImage;
                $galleryImage->product_id = $product->id;
                $galleryImage->gallery_image = ImageHelper::uploadImage($image);
                $galleryImage->save();
                Log::info('Image saved: ' . $galleryImage->gallery_image);
            }
        }


        $notification = array(
            'message' => 'Product Created Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.product.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::findOrFail($id);
        $category = Category::where('status',1)->latest()->get();
        $catalouge = Catalogue::where('status',1)->latest()->get();
       return view('admin.product.view',compact('data','category','catalouge'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Product::with('productCatalogues')->findOrFail($id);
        $category = Category::where('status',1)->latest()->get();
        $catalouge = Catalogue::where('status',1)->get();
        $selectedCatalogueIds = $data->productCatalogues->pluck('catalogue_id')->toArray();
        return view('admin.product.edit',compact('data','category','catalouge','selectedCatalogueIds'));



    }
    public function deleteAttr( $id)
    {
        $data = AttributesSize::findOrFail($id)->delete();
       return response()->json();
    }
    public function deleteImage( $id)
    {
        $data = GalleryImage::findOrFail($id);
        if($data->gallery_image) {
            Storage::disk('public')->delete($data->gallery_image);
        }
        $data->delete();
       return response()->json();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product = Product::findOrFail($id);


        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'title' => 'required',
            'short_description' => 'required',
            'price_rate' => 'required',
            'description' => '',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'serial_number'     => 'nullable|unique:products,serial_number,' . $product->id,
            'catalogue_id' => 'nullable|array',
            'catalogue_id.*' => 'exists:catalogues,id',
        ]);

     
        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : $product->image;
        $meta_image = $request->hasFile('meta_image') ? ImageHelper::uploadImage($request->file('meta_image')) : $product->meta_image;

        if ($request->hasFile('image') && $product->image) {
            Storage::disk('public')->delete($product->image);
        }
        if ($request->hasFile('meta_image') && $product->meta_image) {
            Storage::disk('public')->delete($product->meta_image);
        }
        
        

        $product->update([
            'image' => $image,
            'title' => $request->title,
            'slug' =>  Str::slug($request->title),
            'short_description' => $request->short_description,
            'price_rate' => $request->price_rate,
            'base_charge' => $request->base_charge,
            'additional_charge' => $request->additional_charge,
            'description' => $request->description,
            'cm_length' => $request->cm_length,
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'estimate_status' => $request->estimate_status,
            'featured_status' => $request->featured_status,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'meta_image' => $meta_image,
            'serial_number' => $request->serial_number,
            'number' => $request->number,
            'email' => $request->email,
            'smart_curtains' => $request->smart_curtains,
            'style' => $request->style,
        ]);

        // Remove old catalogue associations
        ProductCatalouge::where('product_id', $product->id)->delete();

        // Add new catalogue associations
        if ($request->catalogue_id) {
            foreach ($request->catalogue_id as $catalogueId) {
                ProductCatalouge::create([
                    'product_id' => $product->id,
                    'catalogue_id' => $catalogueId,
                ]);
            }
        }


        if($request->width){
            foreach($request->width as $key=>$id){
                $attrSize = new AttributesSize;
                $attrSize->product_id = $product->id;
                $attrSize->width = $request->width[$key];
                $attrSize->height = $request->height[$key];
                $attrSize->price = $request->size_price[$key];
                $attrSize->save();
            }
        }



        if($request->old_size_width){
            foreach($request->old_size_width as $key=>$id){
                $attrSize = AttributesSize::findOrFail($key);
                $attrSize->width = $request->old_size_width[$key];
                $attrSize->height = $request->old_size_height[$key];
                $attrSize->price = $request->old_size_price[$key];
                $attrSize->save();
            }
        }


       if($request->hasFile('gallery_image')) {
            foreach ($request->file('gallery_image') as $image) {
                Log::info('Processing image: ' . $image->getClientOriginalName());
                $galleryImage = new GalleryImage;
                $galleryImage->product_id = $product->id;
                $galleryImage->gallery_image = ImageHelper::uploadImage($image);
                $galleryImage->save();
                Log::info('Image saved: ' . $galleryImage->gallery_image);
            }
        }
   

        $notification = array(
            'message' => 'Product Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.product.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Product::findOrFail($id);
        if($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->sizes()->delete();
        foreach($data->images as $image){
            if($image->gallery_image) {
                Storage::disk('public')->delete($image->gallery_image);
            }
            $image->delete();

        }

        $data->productCatalogues()->delete();


        $data->delete();
        $notification = array(
            'message' => 'Product Deleted Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    
    }
    
    // ajax api
    
    public function fetchCatalogue(Request $request)
    {
        $product_id = $request->get('product_id');

        // Fetch ProductCatalouge data with catalogue relation

        // Fetch ProductCatalouge data with catalogue relation and order by catalogue name
        $productCatalogues = ProductCatalouge::where('product_id', $product_id)
        ->with(['catalogue' => function($query) {
            $query->orderBy('name', 'asc'); // Order by catalogue name
        }])
        ->get();


        $response = [];

        foreach ($productCatalogues as $productCatalogue) {
            if ($productCatalogue->catalogue) { // Check if catalogue exists
                $response[] = [
                    'id' => $productCatalogue->catalogue->id,
                    'name' => $productCatalogue->catalogue->name
                ];
            }
        }

        return response()->json(['catalogues' => $response]);
    }
    
    public function fetchCatalogueBookDetails(Request $request)
    {
        $catalogueId = $request->catalogue_id;
        $bookId = $request->book_id;
        $pageId = $request->page_id;
    
        // Fetch the book details
        $book = CatalougeBook::where('catalouge_id', $catalogueId)
                    ->where('id', $bookId)
                    ->first();
    
        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Book not found']);
        }
    
        // Fetch the product based on the selected window product ID
        $product = Product::find($request->product_id);
    
        // Ensure the product exists
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }
    
        // Get the panel width from the book
        $panelWidth = 0;
        if($book->width){
            $panelWidth = (float) $book->width;
        }else{
            $panelWidth = 0;
        }
        
    
        // Get form values (width, height_left, height_middle, height_right)
        $formWidth = (float) $request->width ?? 0;
        $heightLeft = (float) $request->height_left ?? 0;
        $heightMiddle = (float) $request->height_middle ?? 0;
        $heightRight = (float) $request->height_right ?? 0;
    
        // Get the maximum height
        $maxHeight = max($heightLeft, $heightMiddle, $heightRight);
    
        $qty = 0; // Default qty
    
        // Check if the product style is "Roman Blinds"
        if ($product->style === "Roman Blinds") {
            // Add 1 cm buffer and 30 cm extra width and height
            $totalWidth = $formWidth + 1 + 30;
            $totalHeight = $maxHeight + 1 + 30;
    
            // Calculate panel count
            $panelCount = $totalWidth / $panelWidth;
    
            // Calculate quantity
            $qty = ($panelCount * $totalHeight) / 100;
        }
        
        if ($product->style === "Wave Style") {
            // Add 1 cm buffer and 30 cm extra width and height
            $totalWidth = $formWidth * 2.6;
            $totalHeight = $maxHeight + 20;
    
            // Calculate panel count
            $panelCount = round($totalWidth / $panelWidth) + 1;
    
            // Calculate quantity
            $qty = ($panelCount * $totalHeight) / 100;
        }
        
        if ($product->style === "American Style") {
            // Add 1 cm buffer and 30 cm extra width and height
            $totalWidth = $formWidth * 2;
            $totalHeight = $maxHeight + 20;
    
            // Calculate panel count
            $panelCount = round($totalWidth / $panelWidth);
    
            // Calculate quantity
            $qty = ($panelCount * $totalHeight) / 100;
        }
        
    
        return response()->json([
            'success' => true,
            'book' => $book,
            'qty' => number_format($qty, 2)
        ]);
    }
    
    public function fetchCatalogueEditBookDetails(Request $request)
    {
        $catalogueId = $request->catalogue_id;
        $bookId = $request->book_id;
        $pageId = $request->page_id;
        $productId = $request->product_id;
        
        $book = CatalougeBook::where('catalouge_id', $catalogueId)
                    ->where('id', $bookId)
                    ->first();
    
        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Book not found']);
        }
    
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }
    
        $panelWidth = (float) $book->width ?? 0;
        $formWidth = (float) $request->width ?? 0;
        $heightLeft = (float) $request->height_left ?? 0;
        $heightMiddle = (float) $request->height_middle ?? 0;
        $heightRight = (float) $request->height_right ?? 0;
    
        $maxHeight = max($heightLeft, $heightMiddle, $heightRight);
        $qty = 0;
        
         // Check if the product style is "Roman Blinds"
        if ($product->style === "Roman Blinds") {
            $totalWidth = $formWidth + 1 + 30;
            $totalHeight = $maxHeight + 1 + 30;
            $panelCount = $totalWidth / $panelWidth;
            $qty = ($panelCount * $totalHeight) / 100;
        }
        
        if ($product->style === "Wave Style") {
            $totalWidth = $formWidth * 2.6;
            $totalHeight = $maxHeight + 20;
            $panelCount = round($totalWidth / $panelWidth) + 1;
            $qty = ($panelCount * $totalHeight) / 100;
        }
        
        if ($product->style === "American Style") {
            
            $totalWidth = $formWidth * 2;
            $totalHeight = $maxHeight + 20;
            $panelCount = round($totalWidth / $panelWidth);
            $qty = ($panelCount * $totalHeight) / 100;
            
            
           
        }
        
        
       
        return response()->json([
            'success' => true,
            'qty' => number_format($qty, 2)
        ]);
    }


    public function fetchCatalogueBooks(Request $request)
    {
        $catalogueId = $request->catalogue_id;
        $catalogueBooks = CatalougeBook::where('catalouge_id', $catalogueId)->where('status',1)->get();

        return response()->json(['catalogueBooks' => $catalogueBooks]);
    }

    public function fetchPageNumbers(Request $request)
    {
        $bookId = $request->book_id;
        $pageNumbers = PageNumber::where('catalouge_book_id', $bookId)->where('status',1)->get();

        return response()->json(['pageNumbers' => $pageNumbers]);
    }

    
}
