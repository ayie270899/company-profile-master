<?php

namespace App\Services;

use App\Models\ContactMessage;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactMessageService
{
    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return ContactMessage::latest()->paginate($perPage);
    }

    public function getById(int $id): ContactMessage
    {
        return ContactMessage::findOrFail($id);
    }

    public function delete(ContactMessage $message): void
    {
        $message->delete();
    }
}
