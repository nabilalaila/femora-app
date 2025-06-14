<button id="menuToggle" class="md:hidden fixed top-4 left-4 z-50 bg-white p-2 rounded shadow">
    <svg class="w-6 h-6 text-[#312525]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

<div id="sidebar"
    class="fixed top-0 left-0 w-1/2 md:w-1/5 h-screen bg-white z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out border-r border-[#D9D9D9] font-poppins text-base">
    <div class="border-b border-[#D9D9D9] flex items-center justify-center">
        <img src="{{ asset('images/logoFemora.png') }}" alt="Ilustrasi Track Haid"
            class="p-5 w-[145px] object-cover object-left">
    </div>

    <div class="flex flex-col gap-4 mt-5 px-5">
        <div class="flex items-center gap-3 hover:bg-[#F9E8EE] rounded-full px-4 py-2 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#312525] shrink-0" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5" />
            </svg>
            <a href="{{ route('dashboard.index') }}">Dashboard</a>
        </div>

        <div class="ml-4">
            <h5 class="text-gray-400">Kalender Haid</h5>
            <ul class="text-[#312525] mt-2">
                <li class="flex gap-3 hover:bg-[#F9E8EE] rounded-full px-4 py-2 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <a href="{{ route('kalender.index') }}">Kalender</a>
                </li>
            </ul>
        </div>

        <div class="ml-5">
            <h5 class="text-gray-400">Program</h5>
            <ul class="text-[#312525] mt-2 flex flex-col gap-2">
                <li class="flex gap-3 hover:bg-[#F9E8EE] rounded-full px-4 py-2 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                    <a href="">Program tersedia</a>
                </li>
                <li class="flex gap-3 hover:bg-[#F9E8EE] rounded-full px-4 py-2 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <a href="">Riwayat Program</a>
                </li>
            </ul>
        </div>

        <div class="flex gap-3 hover:bg-[#F9E8EE] rounded-full px-4 py-2 transition duration-200 mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
            </svg>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
