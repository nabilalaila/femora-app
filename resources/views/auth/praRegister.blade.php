<x-layout.guest>
    <div class="flex flex-col md:flex-row min-h-screen gap-3 bg-white">
        <div class="hidden md:block w-full md:w-1/2">
            <img src="{{ asset('images/regist-img.png') }}" alt="Ilustrasi Track Haid"
                class="w-full h-full object-cover object-left">
        </div>

        <div class="mt-20 md:mt-0 w-full md:w-1/2 flex items-center justify-center px-6 md:px-12 space-y-5">
            <div class="w-full max-w-lg">
                <h3 class="text-3xl md:text-4xl font-semibold font-inter leading-snug mb-10 text-center">
                    Sign up to <span class="font-crimson font-semibold italic text-[#F5C6D1]">Femora</span>
                </h3>

                <div class="flex justify-center">
                    <a href="{{ url('/auth/google') }}"
                        class="flex items-center justify-center gap-3 font-poppins text-black bg-[#F5C6D1] hover:bg-[#f8d7de] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm w-[400px] px-4 py-2.5 text-center">
                        <img src="https://developers.google.com/static/identity/images/branding_guideline_sample_lt_rd_sl.svg?hl=id"
                            alt="Google Logo" class="w-6 h-6 mr-2">
                        Sign up dengan Google
                    </a>
                </div>

                <div class="flex justify-center my-4 px-10">
                    <img src="{{ asset('images/login.elm.png') }}" alt="or" class="max-w-xs py-3">
                </div>

                <div class="flex justify-center">
                    <a href="{{ route('register') }}"
                        class="flex items-center justify-center gap-3 font-poppins text-black bg-white hover:bg-gray-50 border border-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm w-[400px] px-5 py-2.5 text-center">
                        Lanjutkan dengan Email
                    </a>
                </div>

                <div class="flex justify-center mt-5">
                    <p class="font-poppins text-sm text-gray-500">
                        Sudah punya akun? <a href="{{ route('login') }}" class="underline text-black">Sign In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout.guest>
