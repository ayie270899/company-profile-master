<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function __construct(
        protected PortfolioService $portfolioService
    ) {}

    public function index(): View
    {
        $portfolios = $this->portfolioService->getAll();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create(): View
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'full_content' => 'required|string',
            'project_date' => 'required|date',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $this->portfolioService->create($validated, $request->file('images', []), $request->file('main_image'));

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio berhasil dibuat.');
    }

    public function edit(Portfolio $portfolio): View
    {
        $portfolio->load('images');
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'full_content' => 'required|string',
            'project_date' => 'required|date',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:255',
        ]);

        $this->portfolioService->update($portfolio, $validated, $request->file('images', []), $request->file('main_image'), $request->input('captions', []));

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $this->portfolioService->delete($portfolio);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio berhasil dihapus.');
    }

    public function destroyImage(PortfolioImage $image): RedirectResponse
    {
        $portfolioSlug = $image->portfolio->slug;
        $this->portfolioService->deleteImage($image);

        return redirect()->route('admin.portfolios.edit', $portfolioSlug)
            ->with('success', 'Gambar berhasil dihapus.');
    }
}
