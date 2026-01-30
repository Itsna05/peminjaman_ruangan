document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('detailModal');
    const openButtons = document.querySelectorAll('.btn-edit');
    const closeBtn = document.querySelector('.modal-close');

    // ⛔ JIKA MODAL TIDAK ADA, HENTIKAN SCRIPT INI
    if (!modal) {
        return;
    }

    // buka modal saat klik tombol aksi
    openButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });
    });

    // tutup modal (X)
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }

    // tutup modal saat klik area gelap
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

});
