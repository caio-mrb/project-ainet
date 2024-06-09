<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }}</title>
</head>
<body>
    <h1>Movie Details</h1>

    <x-movies.card :movie="$movie" />

</body>
</html>
