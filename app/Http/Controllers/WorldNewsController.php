<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\News;
use Illuminate\Http\Request;

class WorldNewsController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori dari query string, default 'semua'
        $category = $request->query('category', 'semua');

        // Daftar kategori untuk navbar
        $categories = ['semua', 'politik', 'ekonomi', 'teknologi', 'olahraga', 'hiburan'];

        // Parameter untuk API
        $params = [
            'source-country' => 'id',
            'language' => 'id',
            'number' => 21,
            'api-key' => env('WORLDNEWS_API_KEY'),
        ];

        // Jika kategori bukan 'semua', tambahkan kata kunci pencarian
        if ($category !== 'semua') {
            $params['text'] = $category;
        }

        // Tanpa verifikasi SSL (untuk local dev)
        $response = Http::withoutVerifying()->get('https://api.worldnewsapi.com/search-news', $params);

        if ($response->failed()) {
            $articles = News::latest()->take(21)->get();
            return view('news.index', compact('articles', 'categories', 'category'))
                ->with('error', 'Gagal mengambil berita dari API. Menampilkan data lokal.');
        }

        $data = $response->json();

        // Simpan ke database
        foreach ($data['news'] ?? [] as $item) {
            News::updateOrCreate(
                ['url' => $item['url']],
                [
                    'title' => $item['title'] ?? 'Tanpa Judul',
                    'summary' => $item['text'] ?? null,
                    'image' => $item['image'] ?? null,
                    'published_at' => $item['publish_date'] ?? null,
                ]
            );
        }

        // Ambil 21 berita terbaru dari database
        $articles = News::latest()->take(21)->get();

        return view('news.index', compact('articles', 'categories', 'category'));
    }
}
