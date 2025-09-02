<x-app-layout>
    @section('title') {{ $pageTitle }} | {{ $page->title }} @endsection
    @section('meta_title') {{ $page->title }} @endsection
    @section('meta_description') {{ $page->meta_description ?  $page->meta_description : '' }} @endsection
    @section('meta_keyword') {{ $page->meta_keywords ? $page->meta_keywords : '' }} @endsection
    @section('meta_image') {{ $page->meta_image ? asset('storage/'.$page->meta_image) : '' }} @endsection

    <main class="main">
        <section style="background: #fffaf8;">
         <div class="container">
             <h2 class="headding_all mb-5">{{ $page->title }}</h2>
             {!! $page->content !!}
         </div>
        </section>
 
     </main>
</x-app-layout>