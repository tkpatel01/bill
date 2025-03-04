<p id="message_error" style="color: red;"></p>
<p id="message_success" style="color: green;"></p>

<form action="" method="post" id="verificationform">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="number" name="otp" placeholder="Enter Otp" required>
    <br><br>
    <input type="submit" value="Verify">
</form>

<p class="time"></p>

<button id="resendOtpVerifivation">Resend Otp</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#verificationform').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('verifiedOtp') }}",
                type: "POST",
                data: formData,
                success: function (res) {
                    if (res.success) {
                        alert(res.msg);
                        window.open("pages/index", "_self");
                    } else {
                        $('#message_error').text(res.msg);
                        setTimeout(() => {
                            $('#message_error').text('');
                        }, 3000);
                    }
                }
            });
        });

        $('#resendOtpVerification').click(function (e) {
            $(this).text('Wait....');
            var userMail = @json($email);

            $.ajax({
                url: "{{ route('resendOtp') }}",
                type: "GET",
                data: { email: userMail },
                success: function (res) {
                    $('#resendOtpVerification').text('Resend Otp');
                    if (res.success) {
                        timer();
                        $('#message_success').text(res.msg);
                        setTimeout(() => {
                            $('#message_success').text('');
                        }, 3000);
                    } else {
                        $('#message_error').text(res.msg);
                        setTimeout(() => {
                            $('#message_error').text('');
                        }, 3000);
                    }
                }
            });
        });

        function timer() {
            var secound = 30;
            var minute = 1;

            var timer = setInterval(() => {
                if (minutes < 0) {
                    $('.time').text('');
                    clearInterval(timer);
                } else {
                    let tempMinutes = minutes.toString().length > 1 ? minute : '0' + minutes;
                    let tempMinutes = secound.toString().length > 1 ? secound : '0' + secound;

                    $('.time').text(tempMinutes + ':' + tempMinutes);
                }

                if (secound <= 0) {
                    minutes--;
                    secound = 59;
                }

                secound--;
            }, 1000);
        }
    });
</script>