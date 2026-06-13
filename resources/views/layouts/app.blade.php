<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Stasio Medical Centre — Quality Healthcare at Redcliff Turnoff')</title>
    <meta name="description" content="Stasio Medical Centre is a modern GP surgery at Redcliff Turnoff, Rockodox Filling Station Complex. General consultations, chronic disease management, occupational health, minor procedures, lab sample collection and on-site pharmacy. Serving Redcliff, Kwekwe, Silobela and Zhombe.">
    <meta name="keywords" content="doctor Redcliff, GP Kwekwe, medical centre Redcliff Turnoff, occupational health Kwekwe, medical aid doctor Zimbabwe">
    <link rel="canonical" href="{{ url('/') }}">

    {{-- Social sharing --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="Stasio Medical Centre — Quality Healthcare at Redcliff Turnoff">
    <meta property="og:description" content="General consultations · Medical aids accepted · Occupational health · Pharmacy services. Mon–Fri 08:00–17:00, Sat 08:00–13:00.">
    <meta property="og:url" content="{{ url('/') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Local SEO: structured data --}}
    @verbatim
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "MedicalClinic",
        "name": "Stasio Medical Centre",
        "description": "Modern General Practitioner surgery providing comprehensive primary healthcare.",
        "telephone": "+263552563492",
        "email": "info@stasiomedicalcentre.co.zw",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Shop 5, Stand 2958, Rockodox Filling Station Complex, Redcliff Turnoff",
            "addressLocality": "Redcliff",
            "addressCountry": "ZW"
        },
        "openingHoursSpecification": [
            { "@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"], "opens": "08:00", "closes": "17:00" },
            { "@type": "OpeningHoursSpecification", "dayOfWeek": "Saturday", "opens": "08:00", "closes": "13:00" }
        ]
    }
    </script>
    @endverbatim

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/stasio.css') }}">
</head>
<body>

    {{-- Contact strip: phone + WhatsApp, always visible --}}
    <div class="contact-strip">
        <span class="contact-strip__label">Need a doctor?</span>
        <a href="tel:+263552563492" class="contact-strip__link">Call +263 55 256 3492</a>
        <span class="contact-strip__sep" aria-hidden="true">·</span>
        <a href="https://wa.me/263787421248" class="contact-strip__link">WhatsApp +263 78 742 1248</a>
    </div>

    <header class="site-header">
        <div class="container site-header__inner">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/stasio-logo.png') }}" alt="Stasio Medical Centre" class="brand__logo">
            </a>

            <nav class="site-nav" aria-label="Main">
                <a href="{{ route('home') }}#services">Services</a>
                <a href="{{ route('home') }}#doctor">Our doctor</a>
                <a href="{{ route('home') }}#medical-aid">Medical aid</a>
                <a href="{{ route('home') }}#hours">Hours</a>
                <a href="{{ route('home') }}#contact">Contact</a>
                <a href="{{ route('home') }}#book" class="btn btn--primary btn--small">Book an appointment</a>
            </nav>

            <p class="open-status" id="open-status" aria-live="polite">
                <span class="open-status__dot" aria-hidden="true"></span>
                <span class="open-status__text">Checking hours…</span>
            </p>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- Floating WhatsApp click-to-chat --}}
    <a href="https://wa.me/263787421248?text=Hello%20Stasio%20Medical%20Centre%2C%20I%27d%20like%20to%20make%20an%20enquiry."
       class="whatsapp-float" aria-label="Chat with us on WhatsApp">
        <svg viewBox="0 0 32 32" width="28" height="28" aria-hidden="true" fill="currentColor">
            <path d="M16 3C9.4 3 4 8.4 4 15c0 2.6.8 5 2.3 7L4 29l7.2-2.2c1.9 1 4 1.6 6.2 1.6 6.6 0 12-5.4 12-12S22.6 3 16 3zm0 21.8c-2 0-3.9-.6-5.5-1.6l-.4-.2-4.2 1.3 1.3-4.1-.3-.4C5.6 18.2 5 16.6 5 15 5 9 9.9 4 16 4s11 5 11 11-4.9 9.8-11 9.8zm6-7.3c-.3-.2-1.9-1-2.2-1.1-.3-.1-.5-.2-.7.2-.2.3-.8 1.1-1 1.3-.2.2-.4.2-.7.1-.3-.2-1.4-.5-2.6-1.6-1-.9-1.6-1.9-1.8-2.2-.2-.3 0-.5.1-.7l.5-.6c.2-.2.2-.3.3-.6.1-.2 0-.4 0-.6-.1-.2-.7-1.8-1-2.4-.3-.6-.5-.5-.7-.5h-.6c-.2 0-.6.1-.9.4-.3.3-1.1 1.1-1.1 2.7s1.2 3.1 1.3 3.3c.2.2 2.3 3.6 5.6 5 .8.3 1.4.5 1.9.7.8.2 1.5.2 2.1.1.6-.1 1.9-.8 2.2-1.5.3-.8.3-1.4.2-1.5-.1-.2-.3-.2-.6-.4z"/>
        </svg>
    </a>

    @include('partials.chatbot')

    <footer class="site-footer">
        <div class="container site-footer__grid">
            <div>
                <p class="site-footer__brand">Stasio Medical Centre</p>
                <p>Shop 5, Stand 2958<br>Rockodox Filling Station Complex<br>Redcliff Turnoff, Redcliff, Zimbabwe</p>
            </div>
            <div>
                <p class="site-footer__heading">Contact</p>
                <p>Tel: <a href="tel:+263552563492">+263 55 256 3492</a><br>
                   Mobile: <a href="tel:+263776742125">+263 77 674 2125</a> · <a href="tel:+263719742125">+263 71 974 2125</a><br>
                   WhatsApp: <a href="https://wa.me/263787421248">+263 78 742 1248</a><br>
                   VOIP: <a href="tel:+2638612003100">+263 861 200 3100</a><br>
                   <a href="mailto:info@stasiomedicalcentre.co.zw">info@stasiomedicalcentre.co.zw</a></p>
            </div>
            <div>
                <p class="site-footer__heading">Quick links</p>
                <p><a href="{{ route('home') }}#services">Services</a><br>
                   <a href="{{ route('home') }}#medical-aid">Medical aid partners</a><br>
                   <a href="{{ route('home') }}#book">Book an appointment</a></p>
            </div>
            <div>
                <p class="site-footer__heading">Follow us</p>
                <p><a href="https://www.facebook.com/" rel="noopener">Facebook</a><br>
                   <a href="https://wa.me/263787421248" rel="noopener">WhatsApp</a></p>
                <p class="site-footer__small">Update the Facebook link once the page is created.</p>
            </div>
        </div>
        <div class="container site-footer__legal">
            <p>&copy; {{ date('Y') }} Stasio Medical Centre. Quality, affordable and patient-centred healthcare — serving Redcliff, Kwekwe, Silobela, Zhombe and surrounding communities.</p>
        </div>
    </footer>

    <script>
        // Live open/closed badge.
        // Hours: Mon–Fri 08:00–17:00, Sat 08:00–13:00, Sun & public holidays closed.
        (function () {
            var el = document.getElementById('open-status');
            if (!el) return;
            var now = new Date();
            var day = now.getDay();          // 0 = Sunday
            var mins = now.getHours() * 60 + now.getMinutes();
            var open = false;
            if (day >= 1 && day <= 5) open = mins >= 480 && mins < 1020;
            if (day === 6)            open = mins >= 480 && mins < 780;

            el.querySelector('.open-status__text').textContent =
                open ? 'Open now' : 'Closed — book or WhatsApp us';
            el.classList.add(open ? 'is-open' : 'is-closed');
        })();
    </script>
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    @yield('scripts')
</body>
</html>