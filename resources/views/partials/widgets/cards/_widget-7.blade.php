<div style="width: 850;">
<!--begin::Card widget 7-->
<div class="card card-flush w-md-100 h-md-150 mb-5 mb-xl-10" style="box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);">
    <!--begin::Card body-->
    <div class="card-body d-flex flex-column justify-content-end pe-0">
        @auth
        <!-- This content will only be rendered if the user is authenticated -->
        <div>
            <div>
                <h2>Create a New Post</h2>
                <form action="/create-post" method="POST">
                    @csrf
                    <div>
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter post title">
                    </div>
                    <div>
                        <label for="body" class="form-label">Body Content</label>
                        <textarea class="form-control" id="body" name="body" rows="5" style="resize: none; overflow-y: auto;" placeholder="Enter body content..."></textarea>
                    </div>
                    <br><button type="submit" class="btn btn-primary">Save Post</button>
                </form>
            </div>
        </div>
        @endauth
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 7-->
</div>

