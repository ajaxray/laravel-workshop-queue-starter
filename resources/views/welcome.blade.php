<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Central Bank Of Uganda</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen flex flex-col text-gray-900 font-sans">
    <!-- Navigation -->
    <header class="w-full bg-accent text-white shadow">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <div class="flex items-center gap-3">
                <x-logo />
            </div>
            <nav class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded bg-white text-accent font-medium hover:bg-blue-100 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded bg-white text-accent font-medium hover:bg-blue-100 transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 rounded bg-white text-accent font-medium hover:bg-blue-100 transition">Register</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-1 flex flex-col items-center justify-center text-center px-4 py-16 bg-gradient-to-b from-accent/10 to-white">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-accent">Welcome to the Central Bank Of Uganda</h1>
            <p class="text-lg md:text-xl text-gray-700 mb-8">Empowering Uganda's financial future. We ensure monetary stability, foster economic growth, and safeguard your trust in the nation's financial system.</p>
            <a href="{{ route('account.open') }}" class="inline-block px-8 py-3 mr-2 bg-accent text-white font-semibold rounded shadow hover:bg-blue-800 transition">Create Account</a>
            <a href="#about" class="inline-block px-8 py-3 bg-primary text-primary-content border font-semibold rounded shadow hover:bg-blue-400 transition">Learn More</a>
        </div>
    </main>

    <!-- About/Features Section -->
    <section id="about" class="py-16 bg-blue-50 w-full">
        <div class="container mx-auto px-4 max-w-4xl">
            <h2 class="text-2xl font-bold text-accent mb-6">Our Mandate</h2>
            <div class="grid md:grid-cols-3 gap-8 text-left">
                <div class="bg-white rounded shadow p-6">
                    <h3 class="font-semibold text-lg mb-2 text-accent">Monetary Policy</h3>
                    <p class="text-gray-700">We formulate and implement monetary policy to maintain price stability and support sustainable economic growth.</p>
                </div>
                <div class="bg-white rounded shadow p-6">
                    <h3 class="font-semibold text-lg mb-2 text-accent">Financial Stability</h3>
                    <p class="text-gray-700">We supervise and regulate financial institutions to ensure a sound and resilient financial system for all Ugandans.</p>
                </div>
                <div class="bg-white rounded shadow p-6">
                    <h3 class="font-semibold text-lg mb-2 text-accent">Currency Management</h3>
                    <p class="text-gray-700">We issue and manage the national currency, ensuring its integrity and availability across the country.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 bg-accent text-white text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-4">Partnering for Uganda's Prosperity</h2>
            <p class="mb-6 text-lg">Discover our services, reports, and resources for individuals, businesses, and financial institutions.</p>
            <a href="#" class="inline-block px-8 py-3 bg-white text-accent font-semibold rounded shadow hover:bg-blue-100 transition">Contact Us</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="w-full bg-gray-100 text-gray-600 py-6 mt-auto">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-2">
            <span>&copy; {{ date('Y') }} Central Bank Of Uganda. All rights reserved.</span>
            <span class="text-xs">Designed with <span class="text-accent">Tailwind CSS</span></span>
        </div>
    </footer>
</body>
</html>
