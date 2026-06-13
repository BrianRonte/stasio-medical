<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Department;
use Illuminate\Support\Carbon;

class AppointmentController extends Controller
{
    // WhatsApp number that receives bookings — digits only, no +
    private const WHATSAPP = '263787421248';

    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->validated();

        // 1. Save a copy in our database so no request is ever lost
        $appointment = Appointment::create($data + ['status' => 'pending']);

        // 2. Compose the WhatsApp message
        $service = Department::find($data['department_id']);

        $lines = [
            'APPOINTMENT REQUEST — Stasio Medical Centre',
            'Name: ' . $data['patient_name'],
            'Phone: ' . $data['phone'],
        ];

        if (!empty($data['email'])) {
            $lines[] = 'Email: ' . $data['email'];
        }

        $lines[] = 'Service: ' . ($service?->name ?? '—');
        $lines[] = 'Preferred date: ' . Carbon::parse($data['preferred_date'])->format('D j M Y');

        if (!empty($data['reason'])) {
            $lines[] = 'Reason: ' . $data['reason'];
        }

        $lines[] = 'Ref: #' . $appointment->id;

        // 3. Send the patient to WhatsApp with the message pre-written
        $url = 'https://wa.me/' . self::WHATSAPP . '?text=' . rawurlencode(implode("\n", $lines));

        return redirect()->away($url);
    }
}