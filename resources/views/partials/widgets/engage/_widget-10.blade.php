<!--begin::Engage widget 10-->
<div class="card card-flush h-md-10">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column justify-content-between mt-9 bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0" style="box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);">
        <!--begin::Wrapper-->
        <div class="mb-10">
            <!--begin::Search Form-->
            <form id="searchForm" action="/search" method="GET" class="d-flex align-items-center justify-content-center mb-5">
                <input id="searchInput" type="text" name="search" class="form-control" placeholder="Search for posts..."> <!-- Input field for searching posts -->
            </form>
            <!--end::Search Form-->
        </div>
    </div>
    <!--end::Body-->
</div>
<!--end::Engage widget 10-->

<script>
    // Get the search input field and search form
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    // Add an event listener to the search input field
    searchInput.addEventListener('input', function() {
        // Submit the search form when the input field value changes
        searchForm.submit();
    });
</script>
