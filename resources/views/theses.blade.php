<!DOCTYPE html>
<html>
<head>
    <title>Graduate Theses</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .thesis { border: 1px solid #ccc; margin: 10px 0; padding: 10px; }
        .title { font-weight: bold; font-size: 1.2em; }
        .link { color: blue; }
        .id { color: red; }
    </style>
</head>
<body>
    <h1>Graduate Theses</h1>
    @foreach ($theses as $thesis)
        <div class="thesis">
            <div class="title">{{ $thesis->work_name }}</div>
            <div>{{ $thesis->work_text }}</div>
            <div><a class="link" href="{{ $thesis->work_link }}" target="_blank">{{ $thesis->work_link }}</a></div>
            <div class="id">{{ $thesis->identification_number }}</div>
        </div>
    @endforeach
</body>
</html> 