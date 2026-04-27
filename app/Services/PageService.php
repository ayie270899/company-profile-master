<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PageService
{
    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return Page::with('creator')->latest()->paginate($perPage);
    }

    public function create(array $data, ?UploadedFile $image = null): Page
    {
        $data['slug'] = Str::slug($data['title']);
        $data['created_by'] = auth()->id();

        if ($image) {
            $data['featured_image'] = $image->store('pages', 'public');
        }

        return Page::create($data);
    }

    public function update(Page $page, array $data, ?UploadedFile $image = null): Page
    {
        $data['slug'] = Str::slug($data['title']);

        if ($image) {
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $data['featured_image'] = $image->store('pages', 'public');
        }

        $page->update($data);
        return $page->fresh();
    }

    public function delete(Page $page): void
    {
        if ($page->featured_image) {
            Storage::disk('public')->delete($page->featured_image);
        }
        $page->delete();
    }
}
