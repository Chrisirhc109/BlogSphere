<x-default-layout>

    @section('title')
        Dashboard
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 mb-md-5 mb-xl-10">
            <!-- Adjust column size to 8 -->
            @include('partials/widgets/cards/_widget-7')
            @include('partials/widgets/cards/_widget-20')
        </div>


        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials/widgets/engage/_widget-10')  
        </div>
    </div>
    <!--end::Row-->


</x-default-layout>
