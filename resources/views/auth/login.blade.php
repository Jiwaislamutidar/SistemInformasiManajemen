<x-guest-layout>
    <!-- Screen Wrapper: Fixed h-screen & overflow-hidden (Anti-Scroll) -->
    <div class="relative h-screen w-screen overflow-hidden flex items-center justify-center bg-cover bg-center bg-no-repeat px-4"
         style="background-image: url('{{ asset('images/background.jpg') }}');">

        <!-- Overlay Gelap -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-[3px]"></div>

        <!-- Card Container Login -->
        <div class="relative z-10 w-full max-w-md p-8 bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl text-white">
            
            <!-- Branding Header -->
            <div class="text-center mb-5">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-[#10261C]/80 border border-[#D4AF37]/40 shadow-lg mb-2">
                    <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 17a2 2 0 100 4 2 2 0 000-4zm10 0a2 2 0 100 4 2 2 0 000-4zM3 9l2-4h14l2 4M3 9v8a1 1 0 001 1h1m12 0h1a1 1 0 001-1V9M3 9h18"/>
                    </svg>
                </div>
                <h1 class="text-xl font-bold tracking-tight text-white drop-shadow-md">
                    EXECUTIVE SYSTEM
                </h1>
                <p class="text-[11px] text-gray-300 tracking-wider uppercase font-medium">
                    Dealer Management Portal
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-3 text-emerald-300 text-xs" :status="session('status')" />

            <!-- Form & State Alpine.js -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4" x-data="{ selectedRole: 'owner' }">
                @csrf

                <!-- Role Selector Buttons -->
                <div>
                    <label class="block text-[11px] font-semibold uppercase tracking-wider text-gray-300 mb-1.5 text-center">
                        Pilih Hak Akses Role
                    </label>
                    <div class="grid grid-cols-3 gap-2 bg-black/40 p-1.5 rounded-2xl border border-white/10 relative">
                        <!-- Owner Button -->
                        <button type="button" 
                                @click="selectedRole = 'owner'"
                                :class="selectedRole === 'owner' ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md scale-[1.02]' : 'text-gray-300 hover:text-white hover:bg-white/5'"
                                class="py-2 px-2 rounded-xl text-xs uppercase tracking-wider transition-all duration-300 transform active:scale-95 text-center">
                            Owner
                        </button>

                        <!-- Admin Button -->
                        <button type="button" 
                                @click="selectedRole = 'admin'"
                                :class="selectedRole === 'admin' ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md scale-[1.02]' : 'text-gray-300 hover:text-white hover:bg-white/5'"
                                class="py-2 px-2 rounded-xl text-xs uppercase tracking-wider transition-all duration-300 transform active:scale-95 text-center">
                            Admin
                        </button>

                        <!-- Admin IT Button -->
                        <button type="button" 
                                @click="selectedRole = 'admin_it'"
                                :class="selectedRole === 'admin_it' ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md scale-[1.02]' : 'text-gray-300 hover:text-white hover:bg-white/5'"
                                class="py-2 px-2 rounded-xl text-xs uppercase tracking-wider transition-all duration-300 transform active:scale-95 text-center">
                            Admin IT
                        </button>
                    </div>
                    <input type="hidden" name="role" x-model="selectedRole">
                </div>

                <!-- Email Input (Label di Luar/Atas) -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-200 mb-1">
                        Email Address / Username
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           placeholder="nama@dealer.com"
                           class="w-full px-4 py-3 bg-black/30 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent transition duration-200 text-sm">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-300 text-xs" />
                </div>

                <!-- Password Input (Label di Luar/Atas) -->
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gray-200 mb-1">
                        Password
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           placeholder="••••••••"
                           class="w-full px-4 py-3 bg-black/30 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent transition duration-200 text-sm">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-300 text-xs" />
                </div>

                <!-- Remember Me & Lupa Password -->
                <div class="flex items-center justify-between text-xs pt-0.5">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" 
                               type="checkbox" 
                               name="remember" 
                               class="rounded border-white/30 text-[#10261C] bg-black/40 focus:ring-[#D4AF37] focus:ring-offset-0 w-4 h-4">
                        <span class="ms-2 text-gray-300">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-[#D4AF37] hover:underline font-medium transition" href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button (Tanpa Panah) -->
                <div class="pt-1">
                    <button type="submit" 
                            class="w-full py-3.5 px-4 bg-gradient-to-r from-[#183A2A] to-[#2F5D50] hover:from-[#10261C] hover:to-[#183A2A] text-white text-sm font-semibold rounded-xl border border-[#D4AF37]/50 shadow-lg hover:shadow-emerald-900/40 transition-all duration-300 transform active:scale-[0.98] flex items-center justify-center">
                        <span>MASUK SEBAGAI <span x-text="selectedRole.toUpperCase().replace('_', ' ')"></span></span>
                    </button>
                </div>
            </form>

            <!-- Footer Text -->
            <div class="mt-4 text-center border-t border-white/10 pt-3">
                <p class="text-[10px] text-gray-400">
                    &copy; {{ date('Y') }} SIM Dealer Mobil Exec System.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>