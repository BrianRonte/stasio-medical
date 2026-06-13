<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    private const WHATSAPP = '263787421248';

    public function store(StoreContactMessageRequest $request)
    {
        $data = $request->validated();

        $message = ContactMessage::create($data);

        $lines = [
            'MESSAGE — Stasio Medical Centre website',
            'From: ' . $data['name'],
        ];

        if (!empty($data['phone'])) {
            $lines[] = 'Phone: ' . $data['phone'];
        }

        if (!empty($data['email'])) {
            $lines[] = 'Email: ' . $data['email'];
        }

        $lines[] = '';
        $lines[] = $data['message'];
        $lines[] = '';
        $lines[] = 'Ref: #' . $message->id;

        $url = 'https://wa.me/' . self::WHATSAPP . '?text=' . rawurlencode(implode("\n", $lines));

        return redirect()->away($url);
    }
}