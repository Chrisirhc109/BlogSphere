<!-- Blade Template -->
<x-default-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2 class="card-header mt-15">Profile</h2>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ Auth::user()->profile_photo_path }}" alt="Profile Photo" class="rounded-circle" width="150" height="150">
                        </div>
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="profile_photo" class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                            </div>

                            <div class="d-grid mb-5">
                                <label for="change_password" class="form-label">Password</label>
                                @if(session('password_change_message'))
                                    <div class="alert alert-{{ session('password_change_message_type') }}" role="alert">
                                        {{ session('password_change_message') }}
                                    </div>
                                @endif
                                <button class="btn btn-secondary btn-block" type="button" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>

<!--MODAL-->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('profile.changePassword') }}" id="changePasswordForm">
            @method('PUT')
            @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    
                    <label for="current_password" class="form-label">Current password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">

                    <label for="new_password" class="form-label">New password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">

                    <label for="new_password_confirmation" class="form-label">Repeat password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">

                    <div id="passwordChangeError" class="alert alert-danger d-none mt-3" role="alert">
                        The current password is incorrect.
                    </div>

                </div>

                <div class="modal-footer">
                    <div id="passwordChangeSuccess" class="alert alert-success d-none" role="alert">
                        Password changed successfully.
                    </div>

                    <!-- Button to submit the form -->
                    <button type="submit" class="btn btn-primary" disabled>Save Changes</button>
                    <!-- Button to close the modal -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentPassword = document.getElementById('current_password');
        const newPassword = document.getElementById('new_password');
        const newPasswordConfirmation = document.getElementById('new_password_confirmation');
        const saveChangesBtn = document.querySelector('#changePasswordModal button[type="submit"]');
        const changePasswordForm = document.getElementById('changePasswordForm');
        const passwordChangeSuccess = document.getElementById('passwordChangeSuccess');
        const passwordChangeError = document.getElementById('passwordChangeError');

        function checkInputs() {
            // Check if all input fields have values
            if (currentPassword.value && newPassword.value && newPasswordConfirmation.value) {
                // Enable the button if all fields are filled out
                saveChangesBtn.disabled = false;
            } else {
                // Disable the button if any field is empty
                saveChangesBtn.disabled = true;
            }
        }

        changePasswordForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission behavior

            fetch(changePasswordForm.action, {
                method: 'POST',
                body: new FormData(changePasswordForm),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    passwordChangeSuccess.classList.remove('d-none'); // Show success message
                    passwordChangeError.classList.add('d-none'); // Hide error message
                    changePasswordForm.reset(); // Reset form after successful submission
                    saveChangesBtn.disabled = true; // Disable button after success
                } else {
                    passwordChangeError.textContent = data.message || 'An error occurred.';
                    passwordChangeError.classList.remove('d-none'); // Show error message
                }
            })
            .catch(error => {
                console.error('Error submitting password change form:', error);
                passwordChangeError.textContent = 'An error occurred while changing the password. Please try again.';
                passwordChangeError.classList.remove('d-none'); // Show error message
            });
        });

        currentPassword.addEventListener('input', checkInputs);
        newPassword.addEventListener('input', checkInputs);
        newPasswordConfirmation.addEventListener('input', checkInputs);
    });
</script>
