<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Hi {{ $user->name }} </h2>
    <hr>
    <p>A new blog titled <span style="color: #3490dc;"><strong>{{ $blog->title }}</strong></span> By <span style="color:#3490dc;"><strong> {{ $blog->user->name }} </strong></span> has been publised.</p>
</body>
</html>