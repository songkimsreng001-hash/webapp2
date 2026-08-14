<div class="form-group row mb-3">
    <div class="col-md-8 offset-md-4">
        <!-- Bootstrap Action Button Group -->
        <div aria-label="Auth Navigation Links">
            <a href="{{ route('forget.password.get') }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center" id="btnForgotPassword">
                <i class="bi bi-arrow-counterclockwise me-1"></i>Forgot Password?
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center">
                <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </a>
        </div>
    </div>
</div>

<!-- SweetAlert2 Trigger for Forgot Password Link -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forgotBtn = document.getElementById('btnForgotPassword');
        if (forgotBtn) {
            forgotBtn.addEventListener('click', function (e) {
                e.preventDefault();
                const targetUrl = this.href;

                Swal.fire({
                    title: 'Reset Password?',
                    text: 'Would you like to proceed to the password recovery page?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-arrow-right-circle me-1"></i>Proceed',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = targetUrl;
                    }
                });
            });
        }
    });
</script>