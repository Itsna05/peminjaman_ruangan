document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('modalDetail');
    const closeBtn = document.getElementById('closeModal');
    const openButtons = document.querySelectorAll('.btn-lihat-detail');

    // ⛔ jika modal tidak ada di halaman → STOP
    if (!modal) return;

    /* =====================
       BUKA MODAL
    ===================== */
    openButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });
    });

    /* =====================
       TUTUP MODAL (X)
    ===================== */
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }

    /* =====================
       KLIK AREA GELAP
    ===================== */
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

});
