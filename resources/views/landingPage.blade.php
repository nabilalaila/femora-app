@extends('components.layout.app')

@section('content')
    <section>
        <div class="flex flex-col md:flex-row items-center justify-between px-6 py-12 md:px-40 md: pt-2 pb-20 gap-8 mt-20">
            <div class="space-y-4 max-w-lg text-center md:text-left">
                <h1 class="text-3xl md:text-5xl font-bold font-poppins leading-snug">
                    Track Masa Haid <br>
                    <span class="font-crimson font-semibold italic">Sesuai Syariat</span> Islam
                </h1>
                <p class="font-poppins text-base md:text-lg">
                    Bantu muslimah memahami siklus haid, masa suci, dan waktu ibadah dengan lebih yakin dan nyaman.
                </p>
            </div>
            <div class="w-full md:w-1/3 max-w-xs md:max-w-none">
                <img src="{{ asset('images/pict1_LP.png') }}" alt="Ilustrasi Track Haid" class="w-full h-auto object-contain">
            </div>
        </div>
    </section>
    <section class="bg-[#F7D8E0]">
        <div class="flex flex-col md:flex-row items-center justify-between px-6 py-16 md:px-40 md:py-20 gap-4 md:gap-6">
            <div class="space-y-3 max-w-lg text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold font-poppins leading-tight">
                    <span class="font-crimson font-semibold italic">What is</span> Femora?
                </h1>
                <p class="font-poppins text-base md:text-lg">
                    Femora adalah platform khusus untuk muslimah dari segala usia yang ingin memudahkan tracking siklus haid
                    secara sesuai syariat Islam. Dengan fitur utama pencatatan berdasarkan warna darah, Femora membantu
                    pengguna memahami kapan mereka dalam kondisi haid, nifas, atau istihadhah, sehingga bisa menentukan
                    waktu suci dengan tepat.
                </p>
            </div>
            <div class="w-full md:w-1/3 max-w-xs md:max-w-sm">
                <img src="{{ asset('images/pict2_LP.png') }}" alt="Ilustrasi Track Haid"
                    class="w-full h-auto object-contain">
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="flex flex-col items-center justify-between px-6 py-16 md:px-40 md:py-20 gap-2 md:gap-6">
            <div class="space-y-3 max-w-lg text-center">
                <h1 class="text-3xl md:text-4xl font-bold font-poppins leading-tight">
                    Temukan Kemudahan <br> Bersama <span
                        class="font-crimson font-semibold italic text-[#F5C6D1] text-4xl">Femora</span>
                </h1>
            </div>
            <div class="bg-white px-4 py-12 md:px-10">
                <div class="flex justify-center">
                    <div id="card-container" class="grid grid-cols-1 md:grid-cols-3 gap-10 justify-items-center"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#F7D8E0]">
        <div class="flex flex-col-reverse md:flex-column items-center justify-between px-6 py-16 md:px-10 md:py-20 gap-1">
            <div class="px-4 py-12 md:px-10">
                <div class="flex justify-center">
                    <div id="card-container2" class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-3xl"></div>
                </div>
            </div>
            <div class="space-y-3 max-w-lg text-left md:text-right">
                <h1 class="text-3xl md:text-4xl font-bold font-poppins leading-tight text-left">
                    Kenapa Harus
                    <span class="font-crimson font-semibold italic text-4xl">Femora?</span>
                </h1>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const cardData = [{
                title: "Membuat & Mengelola Data Period",
                content: "Kelola data haid harian sesuai warna darah, bantu identifikasi haid, suci, atau istihadhah secara syar’i."
            },
            {
                title: "Melihat Riwayat Period dan Program",
                content: "Akses riwayat pencatatan dan program yang diikuti untuk pantauan yang lebih jelas dan teratur."
            },
            {
                title: "Mendaftar Program",
                content: "Ikuti program edukasi dan konsultasi untuk memahami fikih haid dengan tepat."
            }
        ];

        const cardData2 = [{
                title: "Pelacak Haid Sesuai Syariat Islam",
                content: "Femora membantu muslimah mengenali jenis darah (haid, suci, istihadhah) berdasarkan warna, sesuai panduan fikih Islam."
            },
            {
                title: "Pencatatan & Riwayat yang Lengkap",
                content: "Catat data period secara fleksibel dan akses riwayat haid serta program yang diikuti dalam satu tampilan."
            },
            {
                title: "Dirancang Khusus untuk Muslimah",
                content: "Fokus pada kenyamanan, privasi, dan kebutuhan muslimah dari segala usia, dengan tampilan yang lembut dan ramah pengguna."
            },
            {
                title: "Edukasi & Bimbingan Islami",
                content: "Tersedia fitur konsultasi dan program edukatif agar pengguna memahami fikih haid dengan benar dan praktis."
            }
        ];

        const container = document.getElementById("card-container");
        const container2 = document.getElementById("card-container2");

        cardData.forEach(item => {
            const card = document.createElement("a");
            card.className =
                "w-72 min-h-[240px] p-6 rounded-lg bg-[#F9E8EE] flex flex-col justify-start text-left";
            card.innerHTML = `
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-black min-h-[64px]">${item.title}</h5>
                <p class="font-normal text-black">${item.content}</p>`;
            container.appendChild(card);
        });

        cardData2.forEach(item => {
            const card2 = document.createElement("a");
            card2.className =
                "w-72 min-h-[240px] p-6 rounded-lg bg-[#F9E8EE] flex flex-col justify-start text-left";
            card2.innerHTML = `
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-black min-h-[64px]">${item.title}</h5>
                <p class="font-normal text-black">${item.content}</p>`;
            container2.appendChild(card2);
        });
    </script>
@endsection
