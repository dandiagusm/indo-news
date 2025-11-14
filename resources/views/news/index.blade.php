<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📰 Indo News</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">📰 Indo News</h1>
            <p class="text-gray-600 text-sm">Berita Trending di Indonesia</p>
        </div>
    </header>

    <section class="py-4 border-b">
        <div class="max-w-7xl mx-auto px-4 flex flex-wrap gap-2 text-sm">
            @foreach ($categories as $cat)
                <a href="{{ url('/?category=' . $cat) }}"
                   class="px-4 py-2 rounded-full border transition-all duration-150
                          {{ $category === $cat 
                                ? 'bg-blue-600 text-white border-blue-600 shadow-sm' 
                                : 'border-gray-300 hover:bg-blue-50' }}">
                    {{ ucfirst($cat) }}
                </a>
            @endforeach
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 py-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($articles as $article)
            <div class="group bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition flex flex-col">

                @if ($article->image)
                    <img 
                        src="{{ $article->image }}" 
                        alt="{{ $article->title }}" 
                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                    >
                @endif

                <div class="p-4 flex flex-col flex-grow">
                    <h2 class="font-semibold text-lg mb-2">
                        <a href="{{ $article->url }}" target="_blank" class="hover:text-blue-600">
                            {{ $article->title }}
                        </a>
                    </h2>

                    <p class="text-sm text-gray-600 mb-4 overflow-hidden transition-all duration-300 ease-in-out max-h-16 group-hover:max-h-60">
                        {{ $article->summary }}
                    </p>

                    <div class="mt-auto text-xs text-gray-400 text-right flex items-center justify-end gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($article->published_at)->diffForHumans() }}
                    </div>
                </div>

            </div>
        @endforeach
    </main>

    <footer class="text-center text-gray-500 text-sm py-6">
        <p>Made with Laravel + World News API</p>
    </footer>

</body>
</html>
