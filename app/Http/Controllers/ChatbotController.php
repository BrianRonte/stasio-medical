<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function reply(Request $request)
    {
        $validated = $request->validate([
            'messages'        => ['required', 'array', 'max:20'],
            'messages.*.role' => ['required', 'in:user,model'],
            'messages.*.text' => ['required', 'string', 'max:1000'],
        ]);

        $system = <<<'PROMPT'
You are the friendly website assistant for Stasio Medical Centre, a GP surgery in Redcliff, Zimbabwe.
Chat naturally and warmly. Keep replies short: one to three sentences, plain language.

Facts you know:
- Location: Shop 5, Stand 2958, Rockodox Filling Station Complex, Redcliff Turnoff, Redcliff. We serve Redcliff, Kwekwe, Silobela, Zhombe and surrounding communities.
- Hours: Mon-Fri 08:00-17:00, Sat 08:00-13:00, closed Sundays and public holidays. After-hours appointments can be arranged on request.
- Contact: phone +263 55 256 3492, WhatsApp +263 78 742 1248, email info@stasiomedicalcentre.co.zw.
- Team: Dr. Stanley Tatenda Mukono, MBChB (UZ), Medical Director and General Practitioner, with a nursing and support team.
- Services: general medical consultations (acute illness, routine check-ups, preventive care, men's, women's, child and elderly health), laboratory sample collection through accredited partner labs, and No. 1 Pharmacy on site.
- Medical aid accepted: PSMAS, First Mutual Health, Bonvie, Cellmed, FBC Health, Maisha, Alliance Health and other approved schemes - patients should confirm cover with reception.
- Booking: the booking form on this page, or by phone/WhatsApp.

Strict rules you must never break:
- Never give medical advice, diagnoses, treatment suggestions, medication recommendations or dosages. If asked anything clinical, briefly empathise and direct the person to book a consultation or message the team on WhatsApp at +263 78 742 1248.
- If a message suggests a medical emergency, tell them to call the centre immediately or go to the nearest emergency department - do not discuss the symptoms.
- Never invent facts, prices or availability. If you don't know something, say so and point them to reception or WhatsApp.
- Stay on topics about the practice; politely decline anything unrelated.

Action buttons: you may end a reply with exactly one of these tags to attach a button:
[ACTION:BOOK] - when the person wants to book, or you are suggesting an appointment.
[ACTION:WHATSAPP] - when the person wants to talk to a person, or whenever you hand off (including every medical question).
[ACTION:CALL] - only for urgent situations.
When you use a tag, do NOT write phone numbers or links in the sentence - the button carries the contact. Keep the sentence short and warm, e.g. "Of course - tap below and the team will take it from there." The tag must be the very last thing in the message.
PROMPT;

            $messages = collect($validated['messages'])->map(fn ($m) => [
                'role'    => $m['role'] === 'model' ? 'assistant' : 'user',
                'content' => $m['text'],
            ])->prepend([
                'role'    => 'system',
                'content' => $system,
            ])->all();

            $response = Http::timeout(20)
                ->withToken(config('services.groq.key'))
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model'       => 'llama-3.3-70b-versatile',
                    'messages'    => $messages,
                    'max_tokens'  => 300,
                    'temperature' => 0.4,
                ]);

        $text = data_get($response->json(), 'choices.0.message.content');

       if (! $response->successful() || ! $text) {
    \Log::error('Gemini error', ['status' => $response->status(), 'body' => $response->body()]);
    return response()->json(['reply' => null], 503);
}
$action = null;
$map = [
    '[ACTION:BOOK]'     => ['label' => 'Open booking form', 'href' => '#book'],
    '[ACTION:WHATSAPP]' => ['label' => 'Chat on WhatsApp',  'href' => 'https://wa.me/263787421248'],
    '[ACTION:CALL]'     => ['label' => 'Call the centre',   'href' => 'tel:+263552563492'],
];

foreach ($map as $tag => $button) {
    if (str_contains($text, $tag)) {
        $action = $button;
        $text   = trim(str_replace($tag, '', $text));
        break;
    }
}

return response()->json(['reply' => $text, 'action' => $action]);
}
}