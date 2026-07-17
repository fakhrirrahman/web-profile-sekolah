<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::query()
            ->latest()
            ->get();

        return view('pages.admin.contacts.index', [
            'messages' => $messages,
            'statuses' => ContactMessage::STATUSES,
        ]);
    }

    public function update(Request $request, ContactMessage $contactMessage): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys(ContactMessage::STATUSES))],
        ]);

        $contactMessage->update($validated);

        flash()->success('Status pesan berhasil diperbarui.');

        return redirect()->route('admin.contact-messages.index');
    }

    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->delete();

        flash()->success('Pesan berhasil dihapus.');

        return redirect()->route('admin.contact-messages.index');
    }
}
