<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Email Verification</title>
</head>
<body>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Well done!</h4>
        <p>Hi {{ $name }}, your email has been registered to CrowdfundMe. Here is your OTP Code :</p>
        <center><mark style="padding: 4px 6px 4px 6px; background: orange; border-radius: 3px; width: 100%; color: black"><b>{{ $otpCode }}</b></mark></center>
        <hr>
        <p class="mb-0"> <b>Never show this code to anyone else</b>, this code will valid until <b>{{ $validUntil }}</b>.</p>
    </div>
</body>
</html>