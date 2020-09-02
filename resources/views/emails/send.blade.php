<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <h2>You have recieved a new mail from {{ $name }}</h2>
    <hr>
    <p><strong>Subject: </strong> {{ $subject }} </p><br>
    <p> {{ $mail_message }} </p>
</body>
</html>