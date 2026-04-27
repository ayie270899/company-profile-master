<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(protected ServiceService $serviceService) {}

    public function index()
    {
        $services = $this->serviceService->getAll();
        return response()->json($services);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'description'=> 'required|string',
            'icon_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $service = $this->serviceService->create($validated, $request->file('icon_image'));

        return response()->json($service, 201);
    }

    public function edit(Service $service)
    {
        return response()->json($service);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'description'=> 'required|string',
            'icon_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $service = $this->serviceService->update($service, $validated, $request->file('icon_image'));

        return response()->json($service);
    }

    public function destroy(Service $service)
    {
        $this->serviceService->delete($service);
        return response()->json(['message' => 'Layanan berhasil dihapus.']);
    }
}
