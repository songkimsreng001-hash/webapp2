<h1>Forget Password Email</h1>

You can reset password from bellow link:
<a href="{{ route('reset.password.get', $token) }}">Reset Password</a>

login.blade.php
button forget password
<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        <div class="checkbox">
            <label>
                <a href="{{ route('forget.password.get') }}">Reset Password</a>
            </label>
        </div>
    </div>
</div>