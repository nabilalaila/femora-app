<x-guest-layout>
    <div class="flex flex-col md:flex-row min-h-screen bg-white">
        <div class="hidden md:block w-full md:w-1/2">
            <img src="{{ asset('images/regist-img.png') }}" alt="Ilustrasi Track Haid"
                class="w-full h-full object-cover object-left">
        </div>

        <div class="mt-20 md:mt-0 w-full md:w-1/2 flex items-center justify-center px-10 md:px-40">
            <div class="w-full max-w-lg">
                <h3 class="text-3xl md:text-4xl font-semibold font-inter leading-snug mb-10 text-center">
                    Sign up to <span class="font-crimson font-semibold italic text-[#F5C6D1]">Femora</span>
                </h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 font-poppins">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                        class="bg-white border border-gray-200 text-black text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror

                    <label for="email" class="block mt-4 mb-2 text-sm font-medium text-gray-900 font-poppins">Email <span class="text-red-500">*</span></label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="bg-white border border-gray-200 text-black text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror

                    <!-- Password -->
                    <label for="password" class="block mt-4 mb-2 text-sm font-medium text-gray-900 font-poppins">Password <span class="text-red-500">*</span></label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        class="bg-white border border-gray-200 text-black text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror

                    <!-- Confirm Password -->
                    <label for="password_confirmation" class="block mt-4 mb-2 text-sm font-medium text-gray-900 font-poppins">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="bg-white border border-gray-200 text-black text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('password_confirmation')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror

                    <button type="submit"
                        class="mt-6 text-black font-poppins bg-[#F5C6D1] hover:bg-[#f8d7de] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm w-full px-5 py-2.5 text-center">
                        Daftar
                    </button>

                    <div class="flex justify-center mt-5">
                        <p class="font-poppins text-sm text-gray-500">
                            Sudah Punya akun? <a href="{{ route('login') }}" class="underline text-black">Sign In</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
