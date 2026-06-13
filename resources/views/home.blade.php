@extends('layouts.app')

@section('content')

    {{-- Hero / banner --}}
    <section class="hero">
        <svg class="hero__motif" viewBox="0 0 300 300" aria-hidden="true" focusable="false">
            <g transform="rotate(38 150 150)">
                <rect x="110" y="40" width="80" height="105" rx="40" fill="#FB9A2F"/>
                <rect x="110" y="155" width="80" height="105" rx="40" fill="#006EA1"/>
            </g>
            <path d="M232 60h10v-10h12v10h10v12h-10v10h-12v-10h-10z" fill="#FB9A2F"/>
            <path d="M262 110h7v-7h9v7h7v9h-7v7h-9v-7h-7z" fill="#006EA1"/>
            <path d="M212 24h6v-6h8v6h6v8h-6v6h-8v-6h-6z" fill="#006EA1"/>
        </svg>
        <div class="container hero__grid">
            <div class="hero__copy">
                <p class="eyebrow">Redcliff Turnoff · Rockodox Filling Station Complex</p>
                <h1>Quality healthcare<br>at Redcliff Turnoff.</h1>
                <p class="hero__lead">
                    Stasio Medical Centre is a modern GP surgery providing quality,
                    affordable and patient-centred healthcare for individuals, families,
                    businesses and organisations in Redcliff, Kwekwe and surrounding communities.
                </p>
                <p class="hero__strapline">General consultations · Medical aids · Occupational health · Pharmacy services</p>
                <div class="hero__actions">
                    <a href="#book" class="btn btn--primary">Book an appointment</a>
                    <a href="https://wa.me/263787421248" class="btn btn--whatsapp">WhatsApp us</a>
                </div>
            </div>

            <aside class="today-card" aria-label="At a glance">
                <p class="today-card__title">At a glance</p>
                <dl class="today-card__rows">
                    <div><dt>Mon – Fri</dt><dd>08:00 – 17:00</dd></div>
                    <div><dt>Saturday</dt><dd>08:00 – 13:00</dd></div>
                    <div><dt>Sun &amp; holidays</dt><dd>Closed</dd></div>
                    <div><dt>Medical aid</dt><dd>Most major schemes accepted</dd></div>
                    <div><dt>Pharmacy</dt><dd>No. 1 Pharmacy on site</dd></div>
                </dl>
                <a href="#book" class="btn btn--primary btn--block">Book online</a>
                <p class="today-card__note">Or call <a href="tel:+263552563492">+263 55 256 3492</a></p>
            </aside>
        </div>
    </section>

    {{-- About --}}
    <section class="section section--sky" id="about">
        <div class="container about__grid">
            <div>
                <p class="eyebrow">About us</p>
                <h2>Patient-centred care, close to home</h2>
                <p>Stasio Medical Centre is dedicated to providing high-quality primary healthcare services to individuals, families and businesses. We focus on preventive healthcare, diagnosis, treatment, chronic disease management, occupational health and minor procedures — delivered in a comfortable, patient-friendly environment.</p>
            </div>
            <div class="values-card">
                <p class="values-card__heading">Our core values</p>
                <ul class="values-list">
                    <li>Compassion</li>
                    <li>Professionalism</li>
                    <li>Integrity</li>
                    <li>Excellence</li>
                    <li>Respect</li>
                    <li>Patient-centred care</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Services --}}
    <section class="section" id="services">
        <div class="container">
            <p class="eyebrow">Our services</p>
            <h2>What we do</h2>
            <p class="section__lead">Comprehensive primary healthcare under one roof.</p>

            <div class="service-feature-wrap">
                @foreach ($departments as $service)
                    <article class="service-feature" style="--sign-colour: {{ $service->colour }}">
                        <div class="service-feature__head">
                            <h3>{{ $service->name }}</h3>
                            <p>{{ $service->tagline }}</p>
                        </div>
                        <ul class="service-feature__list">
                            @foreach ($service->details_list as $item)
                                <li>
                                    <svg viewBox="0 0 20 20" width="18" height="18" aria-hidden="true"><circle cx="10" cy="10" r="9" fill="var(--sign-colour)" opacity="0.12"/><path d="M6 10.2l2.6 2.6L14 7.4" fill="none" stroke="var(--sign-colour)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Doctor / team --}}
    <section class="section section--sky" id="doctor">
        <div class="container">
            <p class="eyebrow">Our team</p>
            <h2>Who will look after you</h2>

            <div class="team__grid">
                @foreach ($doctors as $doctor)
                    <article class="doctor-card doctor-card--feature">
                        <span class="doctor-card__monogram" style="--sign-colour: {{ $doctor->department->colour }}" aria-hidden="true">{{ $doctor->initials }}</span>
                        <div>
                            <h3>{{ $doctor->name }}</h3>
                            <p class="doctor-card__title">{{ $doctor->title }}</p>
                            <p class="doctor-card__bio">{{ $doctor->bio }}</p>
                            <p class="doctor-card__meta">Consults {{ $doctor->days }}</p>
                        </div>
                    </article>
                @endforeach

                <article class="doctor-card">
                    <span class="doctor-card__monogram doctor-card__monogram--team" aria-hidden="true">+</span>
                    <div>
                        <h3>Nursing &amp; support team</h3>
                        <p class="doctor-card__bio">Our trained healthcare and administrative staff work together to ensure patients receive professional, efficient and compassionate care from the moment they enter our facility.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- Medical aid --}}
    <section class="section" id="medical-aid">
        <div class="container">
            <p class="eyebrow">Medical aid partners</p>
            <h2>We accept most major medical aids</h2>

            @php
                $aids = [
                    ['PSMAS', 'psmas'],
                    ['First Mutual Health', 'first-mutual-health'],
                    ['Bonvie Medical Aid', 'bonvie'],
                    ['Cellmed Health Fund', 'cellmed'],
                    ['FBC Health', 'fbc-health'],
                    ['Maisha Health Fund', 'maisha'],
                    ['Alliance Health', 'alliance'],
                ];
            @endphp
            <ul class="aid-grid">
                @foreach ($aids as [$aidName, $aidSlug])
                    <li class="aid-card">
                        @if (file_exists(public_path("images/aids/{$aidSlug}.png")))
                            <img src="{{ asset("images/aids/{$aidSlug}.png") }}" alt="{{ $aidName }}" loading="lazy">
                        @else
                            <span class="aid-card__mark" aria-hidden="true">{{ collect(explode(' ', $aidName))->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->implode('') }}</span>
                            <span class="aid-card__name">{{ $aidName }}</span>
                        @endif
                    </li>
                @endforeach
                <li class="aid-card aid-card--more"><span class="aid-card__name">+ other approved schemes</span></li>
            </ul>
            <p class="section__lead">Please contact reception to confirm your medical aid coverage before your visit.</p>
        </div>
    </section>

    {{-- Why choose us + future --}}
    <section class="section section--sky" id="why">
        <div class="container why__grid">
            <div>
                <p class="eyebrow">Why choose us</p>
                <h2>Why Stasio Medical Centre?</h2>
                <ul class="check-list">
                    <li>Experienced General Practitioner</li>
                    <li>Convenient location at Redcliff Turnoff</li>
                    <li>Comprehensive primary healthcare services</li>
                    <li>Occupational and corporate health services</li>
                    <li>Medical aid accepted</li>
                    <li>Laboratory sample collection services</li>
                    <li>On-site pharmacy</li>
                    <li>Modern consultation and treatment facilities</li>
                    <li>Professional and compassionate healthcare team</li>
                    <li>Serving Redcliff, Kwekwe, Silobela, Zhombe and surrounds</li>
                </ul>
            </div>
            <div class="future-card">
                <p class="eyebrow">Growing with you</p>
                <h3>Future developments</h3>
                <p>As Stasio Medical Centre continues to grow, we aim to expand our services to include:</p>
                <ul class="future-list">
                    <li>On-site laboratory services</li>
                    <li>Radiology and imaging services</li>
                    <li>Specialist outreach clinics</li>
                    <li>Expanded diagnostic services</li>
                </ul>
                <div class="mission-block">
                    <p><strong>Mission</strong> — To provide accessible, affordable and high-quality healthcare services that improve the health and wellbeing of our communities.</p>
                    <p><strong>Vision</strong> — To become a trusted leader in primary healthcare delivery within Redcliff, Kwekwe and surrounding communities.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Hours --}}
    <section class="section" id="hours">
        <div class="container hours__grid">
            <div>
                <p class="eyebrow">Opening hours</p>
                <h2>When to find us</h2>
                <table class="hours-table">
                    <tbody>
                        <tr><th scope="row">Monday – Friday</th><td>08:00 – 17:00</td></tr>
                        <tr><th scope="row">Saturday</th><td>08:00 – 13:00</td></tr>
                        <tr><th scope="row">Sunday</th><td>Closed</td></tr>
                        <tr><th scope="row">Public holidays</th><td>Closed</td></tr>
                    </tbody>
                </table>
                <p class="hours__note">Appointments can be arranged outside normal operating hours where necessary — call or WhatsApp to arrange.</p>
            </div>

            <aside class="emergency-card">
                <p class="emergency-card__label">Need us urgently?</p>
                <p class="emergency-card__big">Call or WhatsApp —<br>we'll point you right.</p>
                <p>For urgent enquiries during opening hours, or to arrange an after-hours appointment:</p>
                <a href="tel:+263552563492" class="btn btn--emergency">Call +263 55 256 3492</a>
                <a href="https://wa.me/263787421248" class="btn btn--whatsapp btn--block-gap">WhatsApp +263 78 742 1248</a>
            </aside>
        </div>
    </section>

    {{-- News --}}
    <section class="section section--sky" id="news">
        <div class="container">
            <p class="eyebrow">News &amp; notices</p>
            <h2>From the noticeboard</h2>

            <div class="news-grid">
                @forelse ($articles as $article)
                    <article class="news-card">
                        <p class="news-card__meta">
                            <span class="news-card__category">{{ $article->category }}</span>
                            <time datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->format('j M Y') }}</time>
                        </p>
                        <h3>{{ $article->title }}</h3>
                        <p>{{ $article->excerpt }}</p>
                    </article>
                @empty
                    <p>No notices at the moment — check back soon.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Booking --}}
    <section class="section section--navy" id="book">
        <div class="container booking__grid">
            <div class="booking__copy">
                <p class="eyebrow eyebrow--light">Appointments</p>
                <h2>Book a visit</h2>
                <p>Tell us what you need and when suits you. Reception confirms every booking by phone or WhatsApp — usually within one working day.</p>
                <p class="booking__alt">Prefer to talk? Call <a href="tel:+263552563492">+263 55 256 3492</a> or <a href="https://wa.me/263787421248">WhatsApp us</a>.</p>
            </div>

            <form method="POST" action="{{ route('appointments.store') }}" class="booking-form" novalidate>
                @csrf

                @if (session('booked'))
                    <p class="form-flash" role="status">{{ session('booked') }}</p>
                @endif

                @if ($errors->hasAny(['patient_name', 'phone', 'email', 'department_id', 'doctor_id', 'preferred_date', 'reason']))
                    <div class="form-errors" role="alert">
                        <p>Please check the following:</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-row">
                    <label for="patient_name">Full name</label>
                    <input type="text" id="patient_name" name="patient_name" value="{{ old('patient_name') }}" required autocomplete="name">
                </div>

                <div class="form-row form-row--split">
                    <div>
                        <label for="phone">Phone / WhatsApp</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="tel" placeholder="+263 …">
                    </div>
                    <div>
                        <label for="email">Email <span class="optional">(optional)</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email">
                    </div>
                </div>

                <div class="form-row form-row--split">
                    <div>
                        <label for="department_id">What do you need?</label>
                        <select id="department_id" name="department_id" required>
                            <option value="" disabled {{ old('department_id') ? '' : 'selected' }}>Choose a service</option>
                            @foreach ($departments as $service)
                                <option value="{{ $service->id }}" @selected(old('department_id') == $service->id)>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="preferred_date">Preferred date</label>
                        <input type="date" id="preferred_date" name="preferred_date" value="{{ old('preferred_date') }}" min="{{ now()->toDateString() }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <label for="reason">Reason for visit <span class="optional">(optional)</span></label>
                    <textarea id="reason" name="reason" rows="3" placeholder="A sentence or two helps us book the right amount of time.">{{ old('reason') }}</textarea>
                </div>

                <button type="submit" class="btn btn--primary btn--block">Request appointment</button>
                <p class="booking-form__fineprint">This is a request, not a confirmed slot. We'll contact you to confirm.</p>
            </form>
        </div>
    </section>

    {{-- Contact + map --}}
    <section class="section" id="contact">
        <div class="container">
            <p class="eyebrow">Find us &amp; get in touch</p>
            <h2>Contact us</h2>
        </div>
        <div class="container contact__grid">
            <div class="map-card">
                <iframe
                    title="Map — Stasio Medical Centre, Redcliff Turnoff"
                    src="https://www.google.com/maps?q=Rockodox%20Filling%20Station%2C%20Redcliff%20Turnoff%2C%20Redcliff%2C%20Zimbabwe&output=embed"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                <address class="map-card__address">
                    Shop 5, Stand 2958, Rockodox Filling Station Complex,<br>
                    Redcliff Turnoff, Redcliff, Zimbabwe
                </address>
            </div>

            <form method="POST" action="{{ route('contact.store') }}" class="booking-form contact-form" novalidate>
                @csrf

                @if (session('contacted'))
                    <p class="form-flash" role="status">{{ session('contacted') }}</p>
                @endif

                @if ($errors->hasAny(['name', 'message']))
                    <div class="form-errors" role="alert">
                        <p>Please check the following:</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-row">
                    <label for="c_name">Your name</label>
                    <input type="text" id="c_name" name="name" value="{{ old('name') }}" required autocomplete="name">
                </div>

                <div class="form-row form-row--split">
                    <div>
                        <label for="c_phone">Phone <span class="optional">(optional)</span></label>
                        <input type="tel" id="c_phone" name="phone" value="{{ old('phone') }}" autocomplete="tel">
                    </div>
                    <div>
                        <label for="c_email">Email <span class="optional">(optional)</span></label>
                        <input type="email" id="c_email" name="email" value="{{ old('email') }}" autocomplete="email">
                    </div>
                </div>

                <div class="form-row">
                    <label for="c_message">Message</label>
                    <textarea id="c_message" name="message" rows="4" required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn--primary btn--block">Send message</button>
            </form>
        </div>
    </section>

@endsection
