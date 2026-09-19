@extends('layouts.app')

@section('content')

<section class="py-16" style="background:linear-gradient(135deg,#F7F3EC,#F0FAF8)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="breadcrumb mb-4"><a href="{{ route('home') }}">Home</a> &rsaquo; <span>Contact</span></div>
        <span class="section-label">Get In Touch</span>
        <h1 class="section-title text-4xl">Book Your Appointment</h1>
        <div class="section-divider"></div>
        <p class="max-w-xl" style="color:var(--muted)">
            Schedule your consultation today and discover the difference personalized, expert care can make.
        </p>
    </div>
</section>

<section class="py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- Contact Info --}}
            <div class="space-y-6">
                @foreach([
                    ['icon'=>'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'title'=>'Our Location', 'value'=>$settings->get('contact_address','Lalitpur, Nepal'), 'href'=>null],
                    ['icon'=>'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'title'=>'Phone', 'value'=>$settings->get('contact_phone'), 'href'=>'tel:'.$settings->get('contact_phone')],
                    ['icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title'=>'Email', 'value'=>$settings->get('contact_email'), 'href'=>'mailto:'.$settings->get('contact_email')],
                    ['icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title'=>'Working Hours', 'value'=>$settings->get('contact_hours'), 'href'=>null],
                ] as $item)
                @if($item['value'])
                <div class="flex gap-4 p-5 rounded-2xl" style="background:var(--primary-light)">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:linear-gradient(135deg,var(--accent),var(--accent-dark))">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-sm mb-1" style="color:var(--primary-dark)">{{ $item['title'] }}</div>
                        @if($item['href'])
                        <a href="{{ $item['href'] }}" class="text-sm" style="color:var(--muted);text-decoration:none">{{ $item['value'] }}</a>
                        @else
                        <span class="text-sm" style="color:var(--muted)">{{ $item['value'] }}</span>
                        @endif
                    </div>
                </div>
                @endif
                @endforeach

                {{-- Social Links --}}
                <div class="p-5 rounded-2xl" style="background:var(--primary-dark)">
                    <h4 class="font-bold mb-4" style="color:#fff">Follow Us</h4>
                    <div class="flex gap-3">
                        @foreach(['social_facebook'=>'Facebook','social_instagram'=>'Instagram','social_youtube'=>'YouTube'] as $key => $name)
                        @if($settings->get($key))
                        <a href="{{ $settings->get($key) }}" target="_blank" rel="noopener"
                           class="px-3 py-1.5 rounded-lg text-xs font-semibold transition"
                           style="background:rgba(255,255,255,0.12);color:#fff"
                           onmouseover="this.style.background='rgba(204,145,52,0.38)';this.style.color='#fff'"
                           onmouseout="this.style.background='rgba(255,255,255,0.12)';this.style.color='#F6F8F4'">
                            {{ $name }}
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Appointment Form --}}
            <div class="lg:col-span-2">
                <div class="rounded-2xl p-8 shadow-lg" style="border:1px solid var(--accent-light)">
                    <h2 class="text-2xl font-bold mb-6" style="color:var(--primary-dark);font-family:'Playfair Display',serif">Request an Appointment</h2>

                    @if($errors->any())
                    <div class="alert-error mb-6">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                            <div>
                                <label class="form-label" for="full_name">Full Name <span style="color:#EF4444">*</span></label>
                                <input type="text" id="full_name" name="full_name"
                                       value="{{ old('full_name') }}"
                                       class="form-input" placeholder="Your full name" required>
                            </div>
                            <div>
                                <label class="form-label" for="phone">Phone Number <span style="color:#EF4444">*</span></label>
                                <input type="tel" id="phone" name="phone"
                                       value="{{ old('phone') }}"
                                       class="form-input" placeholder="+977 98XXXXXXXX" required>
                            </div>
                            <div>
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email') }}"
                                       class="form-input" placeholder="you@example.com">
                            </div>
                            <div>
                                <label class="form-label" for="service">Service Interested In</label>
                                <select id="service" name="service" class="form-input">
                                    <option value="">Select a service...</option>
                                    @foreach($services as $id => $title)
                                    <option value="{{ $title }}" {{ old('service') == $title ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="preferred_date">Preferred Date</label>
                                <input type="date" id="preferred_date" name="preferred_date"
                                       value="{{ old('preferred_date') }}"
                                       min="{{ date('Y-m-d') }}"
                                       class="form-input">
                            </div>
                            <div>
                                <label class="form-label" for="preferred_time">Preferred Time</label>
                                <select id="preferred_time" name="preferred_time" class="form-input">
                                    <option value="">Any time</option>
                                    @foreach(['9:00 AM','10:00 AM','11:00 AM','12:00 PM','1:00 PM','2:00 PM','3:00 PM','4:00 PM','5:00 PM'] as $time)
                                    <option value="{{ $time }}" {{ old('preferred_time') == $time ? 'selected' : '' }}>{{ $time }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="message">Message / Concern</label>
                            <textarea id="message" name="message" rows="4"
                                      class="form-input resize-none"
                                      placeholder="Describe your skin concern or any questions...">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn-primary w-full justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Submit Appointment Request
                        </button>
                        <p class="text-xs text-center mt-3" style="color:var(--muted)">We'll confirm your appointment within 24 hours.</p>
                    </form>
                </div>
            </div>
        </div>

        {{-- Map --}}
        @if($settings->get('google_maps_embed'))
        <div class="mt-12 rounded-2xl overflow-hidden shadow-lg" style="height:380px">
            <iframe src="{{ $settings->get('google_maps_embed') }}"
                    width="100%" height="100%" frameborder="0"
                    style="border:0" allowfullscreen loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Aakar Dermatology Location"></iframe>
        </div>
        @endif
    </div>
</section>

@endsection
