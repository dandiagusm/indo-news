<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Indo News</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .news-item { background: white; padding: 15px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
        img { width: 100%; max-width: 500px; border-radius: 8px; }
        .btn { display: inline-block; background: #007bff; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>

    <h1>📰 Top 20 Trending News Indonesia</h1>
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif
    

    @foreach($articles as $news)
        <div class="news-item">
            <h2><a href="{{ $news->url }}" target="_blank">{{ $news->title }}</a></h2>
            @if($news->image)
                <img src="{{ $news->image }}" alt="Thumbnail">
            @endif
            <p>{{ $news->summary }}</p>
            <small>Sumber: {{ $news->source ?? 'Tidak diketahui' }}</small><br>
            <small>Diterbitkan: {{ \Carbon\Carbon::parse($news->published_at)->diffForHumans() }}</small>
        </div>
    @endforeach

</body>
</html>
