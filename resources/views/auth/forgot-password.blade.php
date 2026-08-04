<!DOCTYPE html>
<html lang="en">

@include('front.header')
@include('front.script')

    <div class="row row-x-center s-styles">
        <div class="column large-6 tab-12">

            <!-- Session Status -->
            <x-auth.session-status :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth.validation-errors :errors="$errors" />

            <p class="h-add-bottom">@lang('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')</p>
            <form class="h-add-bottom" method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <x-auth.input-email />

                <x-auth.submit title="Email Password Reset Link" />

            </form>
        </div>
    </div>

    <!-- End Footer aera -->
    <div class="rbt-separator-mid">
        <div class="container">
            <hr class="rbt-separator m-0">
        </div>
    </div>

    <!-- End Copyright Area  -->
    <div class="rbt-progress-parent">
        <svg class="rbt-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <br> <br><br>
    <div>
        
    </div>
@include('front.footer')
</body>

</html>

