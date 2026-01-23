document.addEventListener('DOMContentLoaded', () => {

  const modal = document.getElementById('modalDetail');
  const closeBtn = document.getElementById('closeModal');

  // tombol lihat detail
  document.querySelectorAll('.btn-lihat-detail').forEach(btn => {
    btn.addEventListener('click', () => {
      modal.style.display = 'flex';
    });
  });

  // tutup modal
  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  // klik luar modal
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });

});
