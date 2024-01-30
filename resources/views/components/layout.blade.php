<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('sass/app.scss') }}" rel="stylesheet">
</head>
<body>
{{ $slot }}
</body>
</html>
