<!DOCTYPE html>
<html lang="en">
@include('backend.partials.head')
<style>
    #other_food_time::-webkit-outer-spin-button,
    #other_food_time::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    #other_food_time {
        -moz-appearance:textfield; /* Firefox */
    }
</style>
<body data-sa-theme="10">
<div class="login">

    <!-- Login -->
    <div class="login__block active" id="l-login">
        <div class="login__block__header">
            <i class="zwicon-user-circle"></i>
            Hi there! Please Sign in

            <div class="actions actions--inverse login__block__actions">
                <div class="dropdown">
                    <i data-toggle="dropdown" class="zwicon-more-h actions__item"></i>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-sa-action="login-switch" data-sa-target="#l-register" href="">Create an account</a>
                        <a class="dropdown-item" data-sa-action="login-switch" data-sa-target="#l-forget-password" href="">Forgot password?</a>
                    </div>
                </div>
            </div>
        </div>

        <form class="login__block__body" id="login_account">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" id="login_email" placeholder="Email Address">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" id="login_password" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-theme btn--icon"><i class="zwicon-checkmark"></i></button>
        </form>
    </div>

    <!-- Register -->
    <div class="login__block" id="l-register">
        <div class="login__block__header">
            <i class="zwicon-user-circle"></i>
            Create an account

            <div class="actions actions--inverse login__block__actions">
                <div class="dropdown">
                    <i data-toggle="dropdown" class="zwicon-more-h actions__item"></i>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-sa-action="login-switch" data-sa-target="#l-login" href="">Already have an account?</a>
                        <a class="dropdown-item" data-sa-action="login-switch" data-sa-target="#l-forget-password" href="">Forgot password?</a>
                    </div>
                </div>
            </div>
        </div>

        <form class="login__block__body" id="register_account">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" id="register_name" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="register_email" placeholder="Email Address">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="register_password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="register_confirm_password" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <select class="form-control page-select" id="register_role">
                    <option value="Teacher">Teacher</option>
                    <option value="Student">Student</option>
                </select>
            </div>

            <button type="submit" class="btn btn-theme btn--icon"><i class="zwicon-checkmark"></i></button>
        </form>
    </div>

    <!-- Forgot Password -->
    <div class="login__block" id="l-forget-password">
        <div class="login__block__header">
            <i class="zwicon-user-circle"></i>
            Forgot Password?

            <div class="actions actions--inverse login__block__actions">
                <div class="dropdown">
                    <i data-toggle="dropdown" class="zwicon-more-h actions__item"></i>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-sa-action="login-switch" data-sa-target="#l-login" href="">Already have an account?</a>
                        <a class="dropdown-item" data-sa-action="login-switch" data-sa-target="#l-register" href="">Create an account</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="login__block__body">
            <p class="mb-5">Please input your account email.</p>

            <div class="form-group">
                <input type="text" class="form-control text-center" placeholder="Email Address">
            </div>

            <button type="button" onclick="alert('Coming soon ...')" class="btn btn-theme btn--icon"><i class="zwicon-checkmark"></i></button>
        </div>
    </div>
</div>
@include('backend.partials.footer')
@include('backend.partials.foot')
<script>
    var auth_messages = [
        "{{ __('global.errors.name_empty') }}",  // 0
        "{{ __('global.errors.name_exist') }}",  // 1
        "{{ __('global.errors.email_empty') }}",  // 2
        "{{ __('global.errors.email_valid') }}",  // 3
        "{{ __('global.errors.email_exist') }}",  // 4
        "{{ __('global.errors.password_empty') }}",  // 5
        "{{ __('global.errors.password_wrong') }}",  // 6
        "{{ __('global.errors.password_length') }}",  // 7
        "{{ __('global.errors.confirm_password_empty') }}",  // 8
        "{{ __('global.errors.confirm_password_wrong') }}"  // 9
    ]
</script>
<script src="{{ url('/common/js/auth.js') }}"></script>
</body>
</html>
