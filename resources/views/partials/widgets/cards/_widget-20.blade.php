<div class="container d-flex justify-content-center align-items-center " style="margin-left: 25%;" >
    <div class="col-12 col-md-10 col-lg-12">
        <!--begin::Card widget 20-->
        <div class="card card-flush mb-2 mb-10" style="box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2); flex-shrink: 0; ">

            <!--begin::Header-->
            <div class="card-body">
                <!--begin::Title-->
                <div>
                    <h2 style="margin-bottom: 10px">All posts</h2>

                    <!--SEARCH-->
                    <div>
                        <!--begin::Search Form-->
                        <form id="searchForm" action="/search" method="GET" class="d-flex align-items-center justify-content-center mb-5">
                            <input id="searchInput" type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="form-control" placeholder="Search for posts...">
                            <button type="submit" class="btn btn-success" style="margin-left: 10px"><i class="bi bi-search"></i></button>
                        </form>
                        <!--end::Search Form-->
                    </div>

                    <!--DISPLAY-->
                    @if ($posts->isEmpty())
                        <p>There is no post.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($posts as $post)
                                <div class="col">
                                    <div class="list-group">
                                        <div class="list-group-item list-group-item-action shadow-lg p-3 mb-5 bg-white rounded">

                                            
                                            <!-- Flex container to display avatar and name/date side by side -->
                                            <div class="d-flex align-items-center mb-3">
                                                <!-- Avatar -->
                                                <div class="symbol symbol-50px me-5">
                                                    @if ($post->user->profile_photo_path)
                                                        <img alt="Profile Avatar" src="{{ $post->user->profile_photo_path }}" />
                                                    @else
                                                        <img alt="Default Avatar" src="{{ asset('profilePic/default/test1.jpg') }}" />
                                                    @endif
                                                </div>
                                                <!-- Name and Date -->
                                                <div>
                                                    <h1 class="card-title">
                                                        
                                                        <div>{{ $post->user->name }}
                                                            <i class="bi bi-dot">({{ $post->created_at->format('M d, Y') }})</i>
                                                        </div>
                                                       
                                                    </h1>
                                                </div>
                                            </div>

                                            <!-- TITLE -->
                                            <h5 class="mb-3">{{ $post->title }}</h5>

                                            <div>
                                                <!-- BODY -->
                                                <div>
                                                    <p>
                                                        <textarea readonly class="form-control" style="width: 100%; overflow: auto; resize: none; border-radius: 10px;">{!! $post->body !!}</textarea>
                                                    </p>
                                                </div>

                                                <!-- IMAGE -->
                                                <div>
                                                    <div class="image-container" style="height: auto; overflow: hidden;">
                                                        @if ($post->image)
                                                            <img src="{{ asset($post->image) }}" class="rounded mx-auto d-block" style="width: 50%; height: 10%; overflow: hidden;" alt="Post Image">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <div class="container">
                                                <div class="row text-center">
                                                    <!-- Enlarge Post Modal -->
                                                    <div class="col">
                                                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#enlargePostModal{{ $post->id }}">
                                                            <i class="bi bi-arrows-angle-expand"></i> Enlarge
                                                        </button>
                                                    </div>
                                                    @if (auth()->user()->id == $post->user_id)
                                                        <!-- Show the buttons if the current user is the author -->
                                                        <div class="col">
                                                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#editPostModal{{ $post->id }}">
                                                                <i class="bi bi-pencil-square"></i> Edit
                                                            </button>
                                                        </div>
                                                        <div class="col">
                                                            <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deletePostModal{{ $post->id }}">
                                                                <i class="bi bi-trash"></i> Delete
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    @endif
                    <!-- End of display for authenticated users -->
                </div>
            </div>
        </div>
        <!--end::Card widget 20-->
    </div>
</div>

@foreach ($posts as $post)
<!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel{{ $post->id }}" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg"> <!-- Adjust modal size as needed -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel{{ $post->id }}">Edit Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editPostForm{{ $post->id }}" action="/edit-post/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- UPLOAD IMAGE -->
                    <div class="mb-3">
                        <label for="imageInputEdit{{ $post->id }}" class="form-label">Upload Image</label>
                        <div class="row g-3 align-items-center">
                            <div class="col-sm-8">
                                <input type="file" id="imageInputEdit{{ $post->id }}" name="image" class="form-control @error('image') is-invalid @enderror">
                            </div>
                            <div class="col-sm">
                                <button type="button" id="clearInputBtnEdit{{ $post->id }}" class="btn btn-warning">Clear Image</button>
                            </div>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="imageErrorEdit{{ $post->id }}" class="text-danger"></div>
                    </div>

                    <!-- TITLE -->
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle{{ $post->id }}" name="title" value="{{ $post->title }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- BODY -->
                    <div class="mb-3">
                        <label class="form-label">Body</label>
                        <textarea class="form-control" name="body" id="editBody{{ $post->id }}" style="resize: vertical; min-height: 200px;">{{ $post->body }}</textarea>
                        @error('body')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="saveChangesBtn{{ $post->id }}" disabled class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Post Modal -->
<div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1" aria-labelledby="deletePostModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePostModalLabel{{ $post->id }}">Confirm Delete: "{{ $post->title }}"?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="DeletePostForm{{ $post->id }}" action="/delete-post/{{ $post->id }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-footer">
                    @if (auth()->user()->id === $post->user_id)
                        <!-- Display delete button if the authenticated user is the owner of the post -->
                        <button type="submit" class="btn btn-danger">Delete</button>
                    @else
                        <!-- Display warning message if the authenticated user is not the owner of the post -->
                        <span class="text-warning">You do not have permission to delete this post.</span>
                    @endif
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Enlarge Post Modal -->
<div class="modal fade" id="enlargePostModal{{ $post->id }}" tabindex="-1" aria-labelledby="enlargePostModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog" style="max-width:85%; max-height=90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enlargePostModalLabel{{ $post->id }}">ENLARGE: {{ $post->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="enlargePostForm{{ $post->id }}">
                @csrf
                <div class="modal-body">
                    @if ($post->image)
                        <img src="{{ asset($post->image) }}" class="rounded mx-auto d-block" style="width: 50%; height:50%">
                    @endif

                    <div class="mb-3">
                        <label for="enlargeTitle{{ $post->id }}" class="form-label">Title</label>
                        <input readonly type="text" style="height:50px" class="form-control" id="enlargeTitle{{ $post->id }}" name="title" value="{{ $post->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="enlargeBody{{ $post->id }}" class="form-label">Body</label>
                        <textarea readonly class="form-control" name="body" id="enlargeBody{{ $post->id }}" style="resize: none; height:500px">{{ $post->body }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach ($posts as $post)
        (function(postId) {
            var editTitle = document.getElementById('editTitle' + postId);
            var editBody = document.getElementById('editBody' + postId);
            var imageInputEdit = document.getElementById('imageInputEdit' + postId);
            var saveChangesBtn = document.getElementById('saveChangesBtn' + postId);
            var clearInputBtnEdit = document.getElementById('clearInputBtnEdit' + postId);
            var imageErrorEdit = document.getElementById('imageErrorEdit' + postId);

            var originalTitle;
            var originalBody;
            var originalImage = imageInputEdit.value;

            function isImageSelected() {
                var file = imageInputEdit.files[0];
                if (file) {
                    var extension = file.name.split('.').pop().toLowerCase();
                    return extension === 'png' || extension === 'jpg' || extension === 'jpeg';
                }
                return true;
            }

            function toggleButtonState() {
                var isValidImage = isImageSelected();
                if ((editTitle.value.trim() !== '' || editBody.value.trim() !== '') && isValidImage) {
                    saveChangesBtn.disabled = false;
                } else {
                    saveChangesBtn.disabled = true;
                }
            }

            editTitle.addEventListener('input', toggleButtonState);
            editBody.addEventListener('input', toggleButtonState);
            imageInputEdit.addEventListener('change', function() {
                var isValidImage = isImageSelected();
                if (!isValidImage) {
                    imageErrorEdit.textContent = 'Invalid format';
                } else {
                    imageErrorEdit.textContent = '';
                }
                toggleButtonState();
            });

            clearInputBtnEdit.addEventListener('click', function() {
                imageInputEdit.value = null;
                imageErrorEdit.textContent = '';
                toggleButtonState();
            });

            $('#editPostModal' + postId).on('show.bs.modal', function() {
                originalTitle = editTitle.value;
                originalBody = editBody.value;
                originalImage = imageInputEdit.value;
            });

            $('#editPostModal' + postId).on('hidden.bs.modal', function() {
                editTitle.value = originalTitle;
                editBody.value = originalBody;
                imageInputEdit.value = originalImage;
                imageErrorEdit.textContent = '';
                toggleButtonState();
            });

            toggleButtonState();
        })({{ $post->id }});
        @endforeach
    });
</script>

<script>
    document.getElementById('searchInput').addEventListener('input', function(event) {
        if (!event.target.value.trim()) {
            window.location.href = "{{ route('dashboard') }}";
        }
    });
</script>
@endforeach
