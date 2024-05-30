<!--CREATE-->
<!--CREATE-->
<!--CREATE-->






<div class="container">
    <div class="row justify-content-center">
        <div class="col-auto">
            <div class="card card-flush mb-xl-10" style="width: 1750px; box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);">
                <div class="card-body d-flex flex-column justify-content-end">
                    <h2>Create a New Post</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreatePostModal">
                        <i class="bi bi-plus-square"></i> What's on your mind, {{ Auth::user()->name }}?
                    </button>

                    @if(session('success'))
                    <div id="successAlert" style="margin-top: 10px" class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="CreatePostModal" tabindex="-1" aria-labelledby="CreatePostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

           <!--Modal Header-->
            <div class="modal-header">
                <h5 class="modal-title" id="CreatePostModalLabel">Create Post</h5>
                
                <!--Button to close the modal-->
                <button type="button" id="xIconbtn" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!--Form for creating a new post-->
            <form id="CreatePostForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="imageInput" class="form-label">Upload Image</label>
                        <label style="color:red">(*PNG,JPG,JPEG)</label>
                        <label style="color:rgb(255, 204, 0)">(Optional)</label>

                        <div class="row g-3">
                            <div class="col-sm-8">
                                <input type="file" id="imageInput" name="image" class="form-control @error('image') is-invalid @enderror flex-grow-1 me-3">
                            </div>
                            <div class="col-sm">
                                <button  type="button" id="clearInputBtnEdit" class="btn btn-warning input-group">Clear image</button>
                            </div>
                        </div>


                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="imageError" class="text-danger"></div>
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
                </div>
                
                <!--Modal Footer-->
                <div class="modal-footer">
                    <button type="button" id="closebtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="createPostBtn" disabled class="btn btn-primary">Create Post</button>
                </div>
            </form>

        </div>
    </div>
</div>






<!--MODAL VERIFICATION BUTTON-->
<script>
    var postTitleInput = document.getElementById('CreateTitle');
    var postBodyInput = document.getElementById('CreateBody');
    var createPostBtn = document.getElementById('createPostBtn');

    var imageInput = document.getElementById('imageInput');
    var imageError = document.getElementById('imageError');

    var clearInputBtn = document.getElementById('clearInputBtn');


    // Function to toggle button disabled state based on input value
    function toggleButtonState() {
        if (postTitleInput.value.trim() !== '' && postBodyInput.value.trim() !== '') {
            createPostBtn.disabled = false;
        } else {
            createPostBtn.disabled = true;
        }
    }

    // Listen for input changes in the input fields
    postTitleInput.addEventListener('input', function() {
        toggleButtonState();
    });

    postBodyInput.addEventListener('input', function() {
        toggleButtonState();
    });

    toggleButtonState();

    // Check if an image file is selected
    function isImageSelected() {
        var file = imageInput.files[0];
        if (file) {
            var extension = file.name.split('.').pop().toLowerCase();
            return extension === 'png' || extension === 'jpg' || extension === 'jpeg';
        }
        return false;
    }

    // Listen for file input changes
    imageInput.addEventListener('change', function() {
        if (!isImageSelected()) {
            // Show error message
            imageError.textContent = 'Invalid format';
        } else {
            // Clear error message
            imageError.textContent = '';
        }
    });


    // Function to clear the file input field
    function clearInput() {
        imageInput.value = null; // Reset the input value
        imageError.textContent = ''; // Clear any error message
    }

    // Listen for click events on the clear input button
    clearInputBtn.addEventListener('click', function() {
        clearInput();
    });

    
</script>



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