<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Services\ContactMessageService;

class ContactMessageController extends Controller
{
    public function __construct(protected ContactMessageService $contactMessageService) {}

    public function index()
    {
        $messages = $this->contactMessageService->getAll();
        return response()->json($messages);
    }

    public function show(ContactMessage $contactMessage)
    {
        return response()->json($contactMessage);
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $this->contactMessageService->delete($contactMessage);
        return response()->json(['message' => 'Pesan berhasil dihapus.']);
    }
}
