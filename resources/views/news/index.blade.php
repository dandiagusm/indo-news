<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📰 Indo News - Trending Hari Ini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">📰 Indo News</h1>
            <p class="text-gray-600 text-sm">Berita Trending di Indonesia</p>
        </div>
    </header>


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto p-4">
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($articles->isEmpty())
            <p class="text-center text-gray-600 mt-10">Belum ada berita untuk ditampilkan.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles as $article)
                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                        @if($article->image)
                            <img src="{{ $article->image }}" alt="{{ $article->title }}" class="h-48 w-full object-cover">
                        @else
                            <div class="h-48 w-full bg-gray-300 flex items-center justify-center text-gray-500">No Image</div>
                        @endif

                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h2 class="text-lg font-semibold mb-2 hover:text-blue-600 transition">
                                    <a href="{{ $article->url }}" target="_blank">{{ Str::limit($article->title, 100) }}</a>
                                </h2>
                                <p class="text-gray-600 text-sm mb-3">
                                    {{ Str::limit($article->summary, 150) }}
                                </p>
                            </div>
                            <div class="flex justify-between items-center text-xs text-gray-500 mt-auto">
                                <span>{{ $article->source ?? 'Tidak diketahui' }}</span>
                                <span>{{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="text-center text-gray-500 text-sm py-6">
        <p>Made with ❤️ using Laravel + World News API</p>
    </footer>
</body>
</html>
