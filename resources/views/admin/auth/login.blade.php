<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Aakar Dermatology</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body {
            background: linear-gradient(135deg, #003D36 0%, #006E61 55%, #004D44 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow: hidden;
        }
        /* Decorative circles */
        body::before {
            content: '';
            position: absolute;
            top: -160px; right: -160px;
            width: 520px; height: 520px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(204,145,52,.18) 0%, transparent 70%);
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -100px; left: -100px;
            width: 360px; height: 360px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0,110,97,.3) 0%, transparent 70%);
        }
        .login-card {
            background: #fff;
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 24px 64px rgba(0,0,0,.25);
            width: 100%; max-width: 420px;
            position: relative; z-index: 1;
        }
        .login-logo {
            width: 60px; height: 60px;
            border-radius: 18px;
            background: linear-gradient(135deg, #006E61, #CC9134);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
            box-shadow: 0 8px 24px rgba(0,110,97,.3);
        }
        .password-wrap {
            position: relative;
        }
        .password-wrap .field-icon {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: #4D7A75;
            width: 1rem;
            height: 1rem;
            pointer-events: none;
        }
        .password-toggle {
            position: absolute;
            right: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            width: 2rem;
            height: 2rem;
            border: 0;
            border-radius: 9999px;
            background: transparent;
            color: #4D7A75;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .password-toggle:hover {
            background: rgba(0,110,97,.08);
            color: #006E61;
        }
        .password-toggle svg {
            width: 1rem;
            height: 1rem;
        }
        .password-toggle .eye-off {
            display: none;
        }
        .password-toggle.show .eye-off {
            display: block;
        }
        .password-toggle.show .eye-on {
            display: none;
        }
    </style>
</head>
<body>

<div class="w-full max-w-md mx-4 relative z-10">

    <div class="login-card">

        {{-- Logo --}}
        <div class="login-logo">
            <span class="text-white font-bold text-2xl" style="font-family:'Playfair Display',serif">AR</span>
        </div>

        <div class="text-center mb-7">
            <h1 class="text-2xl font-bold mb-1" style="color:#003D36;font-family:'Playfair Display',serif">
                Aakar Dermatology
            </h1>
            <p class="text-sm" style="color:#4D7A75">Admin Dashboard — Sign in to continue</p>
        </div>

        @if($errors->any())
        <div class="alert-error mb-5">
            <div class="flex items-start gap-2">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
        </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" novalidate>
            @csrf

            <div class="mb-4">
                <label class="form-label" for="email">Email Address</label>
                <div class="relative">
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           class="form-input pl-10"
                           placeholder="admin@aakardermatology.com"
                           required autofocus>
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"
                         style="color:#4D7A75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            <div class="mb-5">
                <label class="form-label" for="password">Password</label>
                <div class="password-wrap">
                    <input type="password" id="password" name="password"
                           class="form-input pl-10 pr-10"
                           placeholder="••••••••" required>
                    <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 10V7a5 5 0 0110 0v3m-9 0h10a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6a2 2 0 012-2z"/>
                    </svg>
                    <button type="button" class="password-toggle" aria-label="Show password" data-target="password">
                        <svg class="eye-on" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12zm10 2.5A2.5 2.5 0 1112 9a2.5 2.5 0 010 5.5z"/>
                        </svg>
                        <svg class="eye-off" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3l18 18M10.5 10.5A2.5 2.5 0 0013.5 13.5M9.88 5.08A10.94 10.94 0 0112 5c6.5 0 10 7 10 7a17.72 17.72 0 01-4.02 5.18M6.61 6.61A17.95 17.95 0 002 12s3.5 7 10 7a9.74 9.74 0 004.39-1.02"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:#4D7A75">
                    <input type="checkbox" name="remember" class="rounded accent-primary">
                    Remember me
                </label>
            </div>

            <button type="submit" class="btn-primary w-full justify-center text-base py-3">
                Sign In
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </form>

        {{-- Divider --}}
        <div class="mt-6 pt-5 border-t text-center" style="border-color:#E8F7F5">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-1.5 text-sm font-medium transition"
               style="color:#4D7A75" onmouseover="this.style.color='#006E61'" onmouseout="this.style.color='#4D7A75'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to website
            </a>
        </div>
    </div>

    {{-- Brand tagline below card --}}
    <div class="text-center mt-6">
        <p class="text-sm" style="color:rgba(255,255,255,.45)">
            Aakar Dermatology · Skin · Hair · Laser
        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.querySelector('.password-toggle');
        const passwordInput = document.getElementById('password');

        if (toggleButton && passwordInput) {
            toggleButton.addEventListener('click', function () {
                const isHidden = passwordInput.type === 'password';
                passwordInput.type = isHidden ? 'text' : 'password';
                toggleButton.classList.toggle('show', isHidden);
                toggleButton.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            });
        }
    });
</script>
</body>
</html>
