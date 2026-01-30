document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('loanChart');

    if (!canvas) {
        console.error('Canvas loanChart tidak ditemukan');
        return;
    }

    // Ambil data dari Blade
    const dataBulanan = window.dataBulanan || [];

    const ctx = canvas.getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                'Januari', 'Februari', 'Maret', 'April',
                'Mei', 'Juni', 'Juli', 'Agustus',
                'September', 'Oktober', 'November', 'Desember'
            ],
            datasets: [
                {
                    label: 'Total Peminjaman',
                    data: dataBulanan,
                    borderColor: '#15468A',
                    backgroundColor: 'rgba(21,70,138,0.15)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
