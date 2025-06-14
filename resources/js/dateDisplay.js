document.addEventListener('DOMContentLoaded', () => {
    const now = new Date();
    const options = {
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    };
    const formattedDate = now.toLocaleDateString('id-ID', options).replace(/ /g, '-');
    const tanggalEl = document.getElementById("tanggal-sekarang");
    if (tanggalEl) {
        tanggalEl.textContent = formattedDate;
    }
});
