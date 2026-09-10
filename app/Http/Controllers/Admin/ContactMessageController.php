<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.contacts.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);
        return view('admin.contacts.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }

    public function markRead(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);
        return response()->json(['status' => 'ok']);
    }

    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys(ContactMessage::statusOptions()))],
        ]);

        $contactMessage->update(['status' => $validated['status']]);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Status pesan berhasil diperbarui.');
    }
}
