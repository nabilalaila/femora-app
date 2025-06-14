<div class="sticky top-0 backdrop-blur-xl pt-5">
    <nav class="bg-[#F9E8EE] py-3 px-10 rounded-full mx-10 max-w-8xl z-50 shadow-xl">
        <div class="flex items-center w-full">
            <div class="flex items-center space-x-10">
                <img src="{{ asset('images/logoFemora.png') }}" alt="Femora App" class="w-[80px] md:w-[80px]">
                <div class="hidden md:flex space-x-8 text-gray-700 font-medium text-sm">
                    <a href="#" class="hover:text-black font-poppins">About Us</a>
                    <a href="#" class="hover:text-black font-poppins">Shop</a>
                    <a href="#" class="hover:text-black font-poppins">Join Us</a>
                </div>
            </div>

            <div class="hidden md:flex ml-auto space-x-4">
                <a href="{{ route('login') }}"
                    class="bg-white text-gray-800 px-4 py-2 rounded-full hover:bg-gray-100 transition inline-block text-center">
                    Sign In
                </a>
                <a href="{{ route('praRegister') }}"
                    class="bg-[#F5C6D1] text-white px-4 py-2 rounded-full hover:bg-pink-300 transition inline-block text-center">
                    Sign Up
                </a>
            </div>

            <button id="menu-toggle"
                class="md:hidden ml-auto relative z-20 focus:outline-none bg-transparent rounded-none p-2 border-0">
                <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-300" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path id="icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
</div>

<div id="mobile-menu"
    class="md:hidden hidden mt-4 text-center space-y-2 bg-white rounded-none shadow-md absolute left-0 right-0 z-10 px-6 py-4">
    <a href="#" class="block text-gray-700 hover:text-black">About Us</a>
    <a href="#" class="block text-gray-700 hover:text-black">Shop</a>
    <a href="#" class="block text-gray-700 hover:text-black">Join Us</a>

    <div class="space-y-2 pt-2">
        <a href="{{ route('login') }}"
            class="block w-full bg-white text-gray-800 px-4 py-2 rounded-full hover:bg-gray-100 transition text-center">
            Sign In
        </a>
        <a href="{{ route('praRegister') }}"
            class="block w-full bg-[#F5C6D1] text-white px-4 py-2 rounded-full hover:bg-pink-300 transition text-center">
            Sign Up
        </a>
    </div>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIconPath = document.getElementById('icon-path');

        let menuOpen = false;

        toggleBtn.addEventListener('click', () => {
            menuOpen = !menuOpen;
            mobileMenu.classList.toggle('hidden');

            if (menuOpen) {
                menuIconPath.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            } else {
                menuIconPath.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
            }
        });
    });
</script>
