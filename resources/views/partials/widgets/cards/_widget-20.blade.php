<div class="widget-20" style="width: 1700px; ">
    <!--begin::Card widget 20-->
    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10" style="box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <!--begin::Title-->
            <div class="card-title d-flex flex-column">
                <h2>All posts</h2>
                <!-- Display posts only for authenticated users -->
                @if ($posts->isEmpty())
                    <p>There is no post.</p>
                @else
                    <ul>
                        @foreach ($posts as $post)
                            <li>
                                <h3>{{ $post->title }}</h3>
                                <textarea readonly style="width: 1600px; height:100px; overflow:auto; resize: none; border-radius: 10px;">{!! $post->body !!}</textarea>
                                <!-- Edit Post Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enlargePostModal{{$post->id}}">Enlarge</button>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPostModal{{$post->id}}">Edit</button>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePostModal{{$post->id}}">Delete</button>

                                
                                <br><br>
                            </li>
                        @endforeach
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
                <form id="editPostForm{{$post->id}}" action="/edit-post/{{$post->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
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
                        <!-- Button to close the modal -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- Button to submit the form for saving changes -->
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
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
