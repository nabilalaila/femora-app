<x-layout.guest>
    <div class="flex flex-col md:flex-row min-h-screen bg-white">
        <div class="hidden md:block w-full md:w-1/2">
            <img src="{{ asset('images/login-page.png') }}" alt="Ilustrasi Track Haid"
                class="w-full h-full object-cover object-left">
        </div>

        <div class="mt-20 md:mt-0 w-full md:w-1/2 flex items-center justify-center px-10 md:px-40">
            <div class="w-full max-w-lg">
                <h3 class="text-3xl md:text-4xl font-semibold font-inter leading-snug mb-10 text-center">
                    Sign in to <span class="font-crimson font-semibold italic text-[#F5C6D1]">Femora</span>
                </h3>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 font-poppins">Email</label>
                        <input type="email" name="email" id="email" required
                            class="bg-white border border-gray-200 text-black text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan Email">
                        @error('email')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 font-poppins">Password</label>
                        <input type="password" name="password" id="password" required
                            class="bg-white border border-gray-200 text-black text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan Password">
                        @error('password')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="text-black font-poppins bg-[#F5C6D1] hover:bg-[#f8d7de] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm w-full px-5 py-2.5 text-center">
                        Sign in
                    </button>

                    <div class="flex justify-center my-4 px-10">
                        <img src="{{ asset('images/login.elm.png') }}" alt="or" class="max-w-xs py-5">
                    </div>

                    <a href="{{ route('google.redirect') }}"
                        class="flex items-center justify-center gap-3 font-poppins text-black bg-white hover:bg-gray-50 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm w-full px-5 py-2.5 text-center">
                        <img src="https://developers.google.com/static/identity/images/branding_guideline_sample_lt_rd_sl.svg?hl=id"
                            alt="Google Logo" class="w-6 h-6 mr-2">
                        Sign in dengan Google
                    </a>

                    <div class="flex justify-center mt-5">
                        <p class="font-poppins text-sm text-gray-500">
                            Belum Punya akun? <a href="{{ route('praRegister') }}" class="underline text-black">Sign
                                Up</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.guest>
