<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Services\PortfolioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function __construct(protected PortfolioService $portfolioService) {}

    public function index()
    {
        $portfolios = $this->portfolioService->getAll();
        // Attach images count for each portfolio
        $portfolios->each(function ($portfolio) {
            $portfolio->loadCount('images');
        });
        return response()->json($portfolios);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'short_desc'     => 'required|string|max:500',
            'detail_content' => 'required|string',
            'project_date'   => 'required|date',
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $portfolio = $this->portfolioService->create($validated, $request->file('images', []));

        return response()->json($portfolio, 201);
    }

    public function edit(Portfolio $portfolio)
    {
        $portfolio->load('images');
        $portfolio->images->each(function ($img) {
            $img->url = Storage::url($img->image_path);
        });
        return response()->json($portfolio);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'short_desc'     => 'required|string|max:500',
            'detail_content' => 'required|string',
            'project_date'   => 'required|date',
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $portfolio = $this->portfolioService->update($portfolio, $validated, $request->file('images', []));

        return response()->json($portfolio);
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->portfolioService->delete($portfolio);
        return response()->json(['message' => 'Portfolio berhasil dihapus.']);
    }

    public function destroyImage(PortfolioImage $image)
    {
        $this->portfolioService->deleteImage($image);
        return response()->json(['message' => 'Gambar berhasil dihapus.']);
    }
}
