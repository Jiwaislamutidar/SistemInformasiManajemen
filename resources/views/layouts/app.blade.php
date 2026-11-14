<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Dealer Mobil Chery Executive System') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f4f6f3] font-sans antialiased text-[#10261C]">
        <div x-data="{ sidebarOpen: false, sidebarCollapsed: false }" class="min-h-screen">
            <header class="fixed inset-x-0 top-0 z-[60] h-16 border-b border-white/10 bg-[#10261C] text-white shadow-lg">
                <div class="flex h-full items-center justify-between px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <button type="button" @click="window.innerWidth < 1024 ? sidebarOpen = !sidebarOpen : (sidebarCollapsed = !sidebarCollapsed)" class="rounded-lg p-2 text-white transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]" aria-label="Toggle sidebar">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        </button>
                        <a href="{{ Auth::user()->role === 'owner' ? route('owner.dashboard') : (Auth::user()->role === 'admin' ? route('admin.dashboard') : route('adminit.dashboard')) }}" class="flex items-center gap-2">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-[#D4AF37] to-amber-600 text-xs font-bold text-gray-950">SIM</span>
                            <span class="hidden sm:block"><span class="block text-xs font-bold tracking-wider">DEALER MOBIL</span><span class="block text-[10px] font-medium text-amber-300">Executive System</span></span>
                        </a>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="hidden text-right sm:block"><div class="text-xs font-bold">{{ Auth::user()->nama }}</div><div class="text-[10px] capitalize text-amber-300">{{ str_replace('_', ' ', Auth::user()->role) }}</div></div>
                        <a href="{{ route('profile.edit') }}" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#2F5D50] text-sm font-bold text-white transition hover:bg-[#D4AF37] hover:text-gray-950" title="Profile">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</a>
                    </div>
                </div>
            </header>

            @include('layouts.sidebar')
            <div @click="sidebarOpen = false" x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-black/50 lg:hidden" aria-hidden="true"></div>

            <div class="flex min-h-screen flex-col pt-16 transition-all duration-300" :class="sidebarCollapsed ? 'lg:ml-20' : 'lg:ml-64'">
                @isset($header)
                    <header class="border-b border-gray-200 bg-white shadow-sm"><div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">{{ $header }}</div></header>
                @endisset
                <main class="flex-1">{{ $slot }}</main>
                <footer class="border-t border-[#d9dfda] bg-white px-4 py-5 text-center text-xs leading-5 text-gray-500 sm:px-6">© 2026 Dealer Mobil Chery Executive System. All rights reserved. Developed by: Muhammad Jiwa Islamutidar, Medina Fikanti, and Fadly Himawan Saputra.</footer>
            </div>
        </div>
    </body>
</html>
