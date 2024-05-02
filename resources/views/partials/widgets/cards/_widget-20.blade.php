
<div style="width: 1750px; ">
    <!--begin::Card widget 20-->
    <div class="card card-flush mb-2 mb-10" style=" box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <!--begin::Title-->
            <div class="card-title d-flex flex-column">
                <h2 style="margin-bottom: 10px">All posts</h2>

                <div>
                    <!--begin::Search Form-->
                    <form id="searchForm" action="/search" method="GET" class="d-flex align-items-center justify-content-center mb-5" style="margin-left: 25px">
                        <input id="searchInput" type="search" name="search" value="{{ isset($search) ? $search : ''}}" class="form-control" placeholder="Search for posts...">
                        <button type="submit" class="btn btn-success" style="margin-left: 10px"><i class="bi bi-search"></i></button>
                    </form>
                    <!--end::Search Form-->
                </div>


                <!-- Display posts only for authenticated users -->
                @if ($posts->isEmpty())
                    <p>There is no post.</p>
                @else
                    <ul>
                        <div class="row row-cols-1 row-cols-md-3 g-4" >
                            @foreach ($posts as $post)
                                <div class="col" >
                                    <div class="card" style="width: auto;">
                                        <div class="card-body">

                                                <!-- Flex container to display avatar and name/date side by side -->
                                                <div class="d-flex align-items-center mb-3">
                                                    <!-- Avatar -->
                                                    <div class="symbol symbol-50px me-5">
                                                        @if($post->user->profile_photo_url)
                                                            <img alt="Profile Avatar" src="{{ $post->user->profile_photo_url }}"/>
                                                        @else
                                                            <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $post->user->name) }}">
                                                                {{ substr($post->user->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <!-- Name and Date -->
                                                    <div>
                                                        <h3 class="card-title" style="font-weight: bold">{{$post->user->name}} ({{ $post->created_at->format('M d, Y') }})</h3>
                                                    </div>
                                                </div>


                                                <!--TITLE-->
                                                <div>{{ $post->title }}</div>


                                                @if($post->image)
                                                <div class="text-center">
                                                    <img src="{{ asset($post->image) }}" class="rounded mx-auto d-block" style="width: 100px; height:100px">
                                                </div>
                                                @endif

                                                

                                                <!--BODY-->
                                                <p class="card-text">
                                                    <textarea readonly class="form-control" style="width: 100%; height:100px; overflow:auto; resize: none; border-radius: 10px;">{!! $post->body !!}</textarea>
                                                </p>

                                                <div style="align-items: center"> 
                                                    <!-- Edit Post Modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enlargePostModal{{$post->id}}">
                                                        <i class="bi bi-arrows-angle-expand"></i>
                                                        Enlarge
                                                    </button>

                                                    @if(auth()->user()->id == $post->user_id)
                                                        <!-- Show the buttons if the current user is the author -->
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPostModal{{$post->id}}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                        
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePostModal{{$post->id}}">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    @endif
                                                </div>
                                            
                                        </div>
                                    </div>
                                </div>    
                            @endforeach
                        </div>
                    </ul>
                @endif
                <!-- End of display for authenticated users -->
            </div>
        </div>
    </div>
    <!--end::Card widget 20-->
</div>




















{{-- EDIT --}}
@foreach ($posts as $post)
    <!-- This is the start of the Edit Post Modal for the current post -->
    <div class="modal fade" id="editPostModal{{$post->id}}" tabindex="-1" aria-labelledby="editPostModalLabel{{$post->id}}" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" >
                    <h5 class="modal-title" id="editPostModalLabel{{$post->id}}">Edit Post</h5>
                    <!-- Button to close the modal -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>



                
                <!-- Form for editing the post -->
                <form id="editPostForm{{$post->id}}" action="/edit-post/{{$post->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Upload Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <!-- Input field for editing the title -->
                        <div class="mb-3">
                            <label for="editTitle{{$post->id}}" class="form-label">Title</label>
                            <input type="text"  style="height:50px" class="form-control" id="editTitle{{$post->id}}" name="title" value="{{$post->title}}">
                        </div>

                        <!-- Textarea for editing the body -->
                        <div class="mb-3">
                            <label for="editBody{{$post->id}}" class="form-label">Body</label>
                            <textarea class="form-control" name="body" id="editBody{{$post->id}}" style="resize: none; height:200px">{{$post->body}}</textarea>
                        </div>

                    </div>
                    <!-- Modal Footer -->

                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- DELETE --}}
<div class="modal fade" id="deletePostModal{{$post->id}}" tabindex="-1" aria-labelledby="deletePostModalLabel{{$post->id}}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deletePostModalLabel{{$post->id}}">Confirm Delete: "{{$post->title}}"?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
  
        <form id="DeletePostForm{{$post->id}}" action="/delete-post/{{$post->id}}" method="POST">
          @csrf 
          @method('DELETE')
  
            <div class="modal-footer">
                @if(auth()->user()->id === $post->user_id)
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

{{-- ENLARGE --}}
<!-- This is the start of the Edit Post Modal for the current post -->
<div class="modal fade" id="enlargePostModal{{$post->id}}" tabindex="-1" aria-labelledby="enlargePostModalLabel{{$post->id}}" aria-hidden="true">
    <div class="modal-dialog" style="max-width:85%; max-height=90%;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" >
                <h5 class="modal-title" id="enlargePostModalLabel{{$post->id}}">ENLARGE: {{$post->title}}</h5>
                <!-- Button to close the modal -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Form for editing the post -->
            <form id="enlargePostForm{{$post->id}}">
                @csrf
                <div class="modal-body">
                    
                    @if($post->image)
                    <img src="{{ asset($post->image) }}" class="rounded mx-auto d-block" style="width: auto; height:auto">
                    @endif

                    <!-- Input field for editing the title -->
                    <div class="mb-3">
                        <label for="enlargeTitle{{$post->id}}" class="form-label">Title</label>
                        <input readonly type="text"  style="height:50px" class="form-control" id="enlargeTitle{{$post->id}}" name="title" value="{{$post->title}}">
                    </div>
                    <!-- Textarea for editing the body -->
                    <div class="mb-3">
                        <label for="enlargeBody{{$post->id}}" class="form-label">Body</label>
                        <textarea readonly class="form-control" name="body" id="enlargeBody{{$post->id}}" style="resize: none; height:500px">{{$post->body}}</textarea>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <!-- Button to close the modal -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endforeach


<script>
    // Add event listener to search input field
    document.getElementById('searchInput').addEventListener('input', function(event) {
        // Check if the input value is empty
        if (!event.target.value.trim()) {
            // If input value is empty, submit the form
            document.getElementById('searchForm').submit();
        }
    });
</script>