<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\News;

class WorldNewsController extends Controller
{
    public function index()
    {
        // 📰 Fetch from WorldNewsAPI
        $response = Http::withoutVerifying()->get('https://api.worldnewsapi.com/search-news', [

            'source-country' => 'id',
            'language' => 'id',
            'number' => 20, // fetch top 20
            'api-key' => env('WORLDNEWS_API_KEY'),
        ]);

        if ($response->failed()) {
            // if API fails, just show stored data
            $articles = News::latest()->take(20)->get();
            return view('news.index', compact('articles'))
                ->with('error', 'Gagal mengambil berita dari API. Menampilkan data lokal.');
        }

        $data = $response->json();

        // 💾 Save to MySQL (avoid duplicates)
        foreach ($data['news'] ?? [] as $item) {
            News::updateOrCreate(
                ['url' => $item['url']],
                [
                    'title' => $item['title'] ?? 'Tanpa Judul',
                    'source' => $item['source_name'] ?? null,
                    'summary' => $item['text'] ?? null,
                    'image' => $item['image'] ?? null,
                    'published_at' => $item['publish_date'] ?? null,
                ]
            );
        }

        // 🧠 Load latest 20 from DB
        $articles = News::latest()->take(20)->get();

        return view('news.index', compact('articles'));
    }
}
