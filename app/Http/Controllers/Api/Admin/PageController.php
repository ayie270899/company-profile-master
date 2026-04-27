<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\PageService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(protected PageService $pageService) {}

    public function index()
    {
        $pages = $this->pageService->getAll();
        return response()->json($pages);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $page = $this->pageService->create($validated, $request->file('featured_image'));

        return response()->json($page, 201);
    }

    public function edit(Page $page)
    {
        return response()->json($page);
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $page = $this->pageService->update($page, $validated, $request->file('featured_image'));

        return response()->json($page);
    }

    public function destroy(Page $page)
    {
        $this->pageService->delete($page);
        return response()->json(['message' => 'Halaman berhasil dihapus.']);
    }
}
