<!--SEARCH-->
<!--SEARCH-->
<!--SEARCH-->

<!--begin::Engage widget 10-->
<div class="card card-flush h-md-10">
    
    <!--begin::Body-->
    <div class="card-body d-flex flex-column pb-0" style="box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);">
        <h5 class="card-title">Search Post</h5>
        <!--begin::Wrapper-->
        <div>
            <!--begin::Search Form-->
            <form id="searchForm" action="/search" method="GET" class="d-flex align-items-center justify-content-center mb-5">
                <input id="searchInput" type="search" name="search" value="{{ isset($search) ? $search : ''}}" class="form-control" placeholder="Search for posts...">
            </form>
            <!--end::Search Form-->
        </div>
    </div>
    <!--end::Body-->
    
</div>
<!--end::Engage widget 10-->
