<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __construct(
        protected ServiceService $serviceService
    ) {}

    public function index(): View
    {
        $services = $this->serviceService->getAll();
        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'description' => 'required|string',
            'icon_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $this->serviceService->create($validated, $request->file('icon_image'));

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dibuat.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'description' => 'required|string',
            'icon_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $this->serviceService->update($service, $validated, $request->file('icon_image'));

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $this->serviceService->delete($service);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
