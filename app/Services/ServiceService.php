<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceService
{
    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return Service::with('creator')->latest()->paginate($perPage);
    }

    public function create(array $data, ?UploadedFile $icon = null): Service
    {
        $data['slug'] = Str::slug($data['title']);
        $data['created_by'] = auth()->id();

        if ($icon) {
            $data['icon_image'] = $icon->store('services', 'public');
        }

        return Service::create($data);
    }

    public function update(Service $service, array $data, ?UploadedFile $icon = null): Service
    {
        $data['slug'] = Str::slug($data['title']);

        if ($icon) {
            if ($service->icon_image) {
                Storage::disk('public')->delete($service->icon_image);
            }
            $data['icon_image'] = $icon->store('services', 'public');
        }

        $service->update($data);
        return $service->fresh();
    }

    public function delete(Service $service): void
    {
        if ($service->icon_image) {
            Storage::disk('public')->delete($service->icon_image);
        }
        $service->delete();
    }
}
