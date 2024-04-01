<x-default-layout>
        
    @section('title')
    Google Graph
    @endsection

    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        
        <!-- Column for Line Graph -->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials/graphs/Google-Graph')
        </div>

    </div>
</x-default-layout>
