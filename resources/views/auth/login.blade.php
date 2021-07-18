@extends('layout.app')
@section('title','Login')
@push('header_scripts')

@endpush
@section('main')
    <div class="wrapper">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                Sign In
            </div>

            <!-- Login Form -->
            <form id="sign-in-form" data-parsley-validate="">
                <div class="form-group">
                    <b><span class="text-success" id="success-message"> </span><b>
                </div>
                <div class="form-group">
                    <input type="email" id="email" class="formRow fadeIn second" name="email" placeholder="Email">
                    <span class="text-danger" id="email-error"></span>
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="formRow fadeIn third" name="password" placeholder="Password">
                    <span class="text-danger" id="password-error"></span>
                </div>

                <input type="submit" class="fadeIn fourth" value="Sign In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Reset Password</a>
            </div>

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

        $(document).on('submit','#sign-in-form', function(event){
            event.preventDefault();
            $('#email-error').text('');
            $('#password-error').text('');

            if ($(this).parsley().isValid() === false ) {
                console.log("form is not valid");
                return false;
            }
            else {
                $.ajax({
                    url: "{!! route('login.submit') !!}",
                    type: "POST",
                    data: $('#sign-in-form').serialize(),
                    success: function (response) {
                        console.log(response);
                        if (response && response.status) {
                            $('#success-message').text(response.message);
                            $("#sign-in-form")[0].reset();
                            window.setTimeout(function () {
                                window.location.href = "{!! route('home') !!}";
                            }, 1000);
                        }
                    },
                    error: function (response) {
                        $('#email-error').text(response.responseJSON.errors.email);
                        $('#password-error').text(response.responseJSON.errors.password);
                    }
                });
            }
        });
    </script>
@endpush
