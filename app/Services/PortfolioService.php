<?php

namespace App\Services;

use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioService
{
    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return Portfolio::with(['creator', 'images'])->latest()->paginate($perPage);
    }

    public function create(array $data, array $images = [], ?UploadedFile $mainImage = null): Portfolio
    {
        $data['slug'] = Str::slug($data['title']);
        $data['created_by'] = auth()->id();

        if ($mainImage) {
            $data['main_image_url'] = $mainImage->store('portfolios', 'public');
        }

        $portfolio = Portfolio::create($data);

        foreach ($images as $image) {
            if ($image instanceof UploadedFile) {
                $portfolio->images()->create([
                    'image_path' => $image->store('portfolios/gallery', 'public'),
                ]);
            }
        }

        return $portfolio->load('images');
    }

    public function update(Portfolio $portfolio, array $data, array $images = [], ?UploadedFile $mainImage = null, array $captions = []): Portfolio
    {
        $data['slug'] = Str::slug($data['title']);

        if ($mainImage) {
            // Hapus gambar lama jika ada
            if ($portfolio->main_image_url) {
                Storage::disk('public')->delete($portfolio->main_image_url);
            }
            $data['main_image_url'] = $mainImage->store('portfolios', 'public');
        }

        $portfolio->update($data);

        // Update Captions untuk gambar yang sudah ada
        foreach ($captions as $imageId => $captionText) {
            $existingImage = $portfolio->images()->find($imageId);
            if ($existingImage) {
                $existingImage->update(['caption' => $captionText]);
            }
        }

        foreach ($images as $image) {
            if ($image instanceof UploadedFile) {
                $portfolio->images()->create([
                    'image_path' => $image->store('portfolios/gallery', 'public'),
                ]);
            }
        }

        return $portfolio->fresh(['images']);
    }

    public function delete(Portfolio $portfolio): void
    {
        if ($portfolio->main_image_url) {
            Storage::disk('public')->delete($portfolio->main_image_url);
        }

        foreach ($portfolio->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $portfolio->delete();
    }

    public function deleteImage(PortfolioImage $image): void
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
    }
}
