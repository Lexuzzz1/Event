<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            
            .glass-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            
            .floating-animation {
                animation: float 6s ease-in-out infinite;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            
            .pulse-animation {
                animation: pulse 3s ease-in-out infinite;
            }
            
            @keyframes pulse {
                0%, 100% { opacity: 0.6; }
                50% { opacity: 0.8; }
            }
            
            .fade-in {
                animation: fadeIn 0.8s ease-in-out;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            .btn-modern {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                border-radius: 12px;
                padding: 12px 24px;
                color: white;
                font-weight: 600;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            }
            
            .btn-modern:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
            }
            
            .input-modern {
                border: 2px solid rgba(226, 232, 240, 0.8);
                border-radius: 12px;
                padding: 12px 16px;
                transition: all 0.3s ease;
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
            }
            
            .input-modern:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
                background: white;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased gradient-bg min-h-screen">
        <!-- Background Elements -->
        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-white rounded-full mix-blend-overlay filter blur-xl opacity-20 floating-animation"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-white rounded-full mix-blend-overlay filter blur-xl opacity-20 floating-animation" style="animation-delay: -3s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-white rounded-full mix-blend-overlay filter blur-xl opacity-10 pulse-animation"></div>
        </div>
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <!-- Logo Section -->
            <div class="fade-in">
                <a href="/" class="flex flex-col items-center mb-8">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white mt-4 tracking-wide">
                        {{ config('app.name', 'Laravel') }}
                    </h1>
                    <p class="text-white/80 text-sm mt-1">Selamat datang kembali</p>
                </a>
            </div>

            <!-- Main Card -->
            <div class="w-full sm:max-w-md fade-in" style="animation-delay: 0.2s;">
                <div class="glass-card px-8 py-8 shadow-2xl rounded-2xl border-0 hover:shadow-3xl transition-all duration-300">
                    {{ $slot }}
                </div>
            </div>
            
            <!-- Footer -->
            <div class="mt-8 text-center fade-in" style="animation-delay: 0.4s;">
                <p class="text-white/60 text-sm">
                    © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                </p>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="fixed bottom-0 left-0 w-full h-32 bg-gradient-to-t from-black/10 to-transparent pointer-events-none"></div>
        <div class="fixed top-0 left-0 w-full h-32 bg-gradient-to-b from-black/10 to-transparent pointer-events-none"></div>
    </body>
</html>