<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PpdbRegistrationController extends Controller
{
    public function status(Request $request): View
    {
        $lookupRegistrations = PpdbRegistration::query()
            ->latest()
            ->get(['registration_number', 'student_name', 'desired_grade']);

        if (! $request->has('registration_number')) {
            return view('pages.ppdb-status', [
                'lookupRegistrations' => $lookupRegistrations,
            ]);
        }

        $validated = $request->validateWithBag('statusLookup', [
            'registration_number' => ['required', 'string', 'max:255'],
        ]);

        $registration = PpdbRegistration::query()
            ->with('statusHistories')
            ->where('registration_number', $validated['registration_number'])
            ->first();

        return view('pages.ppdb-status', [
            'lookupRegistrations' => $lookupRegistrations,
            'statusRegistration' => $registration,
            'statusSearch' => $validated,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'desired_grade' => ['required', 'string', 'max:255'],
            'previous_school' => ['nullable', 'string', 'max:255'],
            'parent_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $registration = PpdbRegistration::create($validated);

        flash()->success('Pendaftaran berhasil dikirim. Nomor pendaftaran: ' . $registration->registration_number);

        return redirect()
            ->route('ppdb.status')
            ->with('registration_number', $registration->registration_number);
    }
}
