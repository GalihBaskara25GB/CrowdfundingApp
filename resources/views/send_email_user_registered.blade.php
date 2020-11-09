<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
        Hi {{ $name }}, here is your OTP Code: 
        <mark style="padding: 4px 6px 4px 6px; background: orange; border-radius: 3px; width: 100%; color: black"><b>{{ $otpCode }}</b></mark>.
        <br/>
        Never show this code to anyone else, this code will valid until {{ $validUntil }}
    </p>
</body>
</html>