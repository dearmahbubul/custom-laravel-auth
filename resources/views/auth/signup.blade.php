@extends('layout.app')
@section('title','Signup')
@push('header_scripts')

@endpush
@section('main')
    <div class="wrapper">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                Sign Up
            </div>

            <!-- Login Form -->
            <form id="sign-up-form" data-parsley-validate="">
                <div class="form-group">
                    <b><span class="text-success" id="success-message"> </span><b>
                </div>
                <div class="form-group">
                    <input type="text" id="name" class="formRow fadeIn second" name="name" placeholder="Name" required>
                    <span class="text-danger" id="name-error"></span>
                </div>
                <div class="form-group">
                    <input type="text" id="company" class="formRow fadeIn second" name="company" placeholder="Company" required >
                    <span class="text-danger" id="company-error"></span>
                </div>
                <div class="form-group">
                    <input type="email" id="email" class="formRow fadeIn second" name="email" placeholder="Email" required>
                    <span class="text-danger" id="email-error"></span>
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="formRow fadeIn third" name="password" placeholder="Password" required>
                    <span class="text-danger" id="password-error"></span>
                </div>
                <div class="form-group">
                    <input type="password" id="password-confirmation" class="formRow fadeIn third" name="password_confirmation" placeholder="Repeat password" required>
                    <span class="text-danger" id="password-confirmation-error"></span>
                </div>

                <input type="submit" class="fadeIn fourth" value="Sign Up">
            </form>

        </div>
    </div>
@endsection
@push('footer_scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('submit','#sign-up-form', function(event){
            event.preventDefault();
            $('#name-error').text('');
            $('#company-error').text('');
            $('#email-error').text('');
            $('#password-error').text('');
            $('#password-confirmation-error').text('');

            if ($(this).parsley().isValid() === false ) {
                console.log("form is not valid");
                return false;
            }
            else {
                $.ajax({
                    url: "{!! route('signup.submit') !!}",
                    type: "POST",
                    data: $('#sign-up-form').serialize(),
                    success: function (response) {
                        if (response && response.status) {
                            $('#success-message').text(response.message);
                            $("#sign-up-form")[0].reset();
                            window.setTimeout(function () {
                                window.location.href = "{!! route('login') !!}";
                            }, 1000);
                        }
                    },
                    error: function (response) {
                        $('#name-error').text(response.responseJSON.errors.name);
                        $('#company-error').text(response.responseJSON.errors.company);
                        $('#email-error').text(response.responseJSON.errors.email);
                        $('#password-error').text(response.responseJSON.errors.password);
                        $('#password-confirmation-error').text(response.responseJSON.errors.password_confirmation);
                    }
                });
            }
        });
    </script>
@endpush
