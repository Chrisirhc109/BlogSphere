<!--CREATE-->
<!--CREATE-->
<!--CREATE-->

<!--begin::Card widget 7-->
<div class="card card-flush mb-xl-10" style="width:1750px; box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);">
    <!--begin::Card body-->
    <div class="card-body d-flex flex-column justify-content-end">
        @auth
        <!-- This content will only be rendered if the user is authenticated -->
        <div>
            <div>
                <h2>Create a New Post</h2>
                <form action="/create-post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Upload Image</label> <label style="color:rgb(255, 204, 0)">(Optional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="CreateTitle" class="form-label">Title</label> <label style="color:red">(Required)</label>
                        <input type="text" style="height:50px" class="form-control" id="CreateTitle" name="title" value="{{ old('title') }}">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="CreateBody" class="form-label">Body</label> <label style="color:red">(Required)</label>
                        <textarea class="form-control" name="body" id="CreateBody" style="resize: none; height:200px">{{ old('body') }}</textarea>
                        @error('body')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if(session('success'))
                    <div id="successAlert" class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>
            </div>
        </div>
        @endauth
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 7-->

<script>
    // Timeout function to remove the success message after 5 seconds
    setTimeout(function() 
    {
        var successAlert = document.getElementById('successAlert');
        if (successAlert) {
            successAlert.remove();
        }

    }, 5000); // 5000 milliseconds = 5 seconds

</script>



<!--
<div class="card card-flush mb-xl-10" style="width:1750px; box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);">
    
    <div class="card-body d-flex flex-column justify-content-end">
        <h2>Create a New Post</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreatePostModal">
            <i class="bi bi-plus-square"></i> What's on your mind, {{ Auth::user()->name }}?
        </button>
    </div>
    
</div>
-->

<!--
<div class="modal fade" id="CreatePostModal" tabindex="-1" aria-labelledby="CreatePostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

           Modal Header
            <div class="modal-header">
                <h5 class="modal-title" id="CreatePostModalLabel">Create Post</h5>
                
                Button to close the modal
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            Form for creating a new post
            <form id="CreatePostForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Upload Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="CreateTitle" class="form-label">Title</label>
                        <input type="text" style="height:50px" class="form-control" id="CreateTitle" name="title" value="{{ old('title') }}">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="CreateBody" class="form-label">Body</label>
                        <textarea class="form-control" name="body" id="CreateBody" style="resize: none; height:200px">{{ old('body') }}</textarea>
                        @error('body')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                Modal Footer
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </div>
            </form>

        </div>
    </div>
</div>
-->