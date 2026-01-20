const ctx = document.getElementById('loanChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul'],
        datasets: [
            {
                label: 'Disetujui',
                data: [10, 30, 20, 40, 25, 35, 20],
                borderColor: '#2563eb',
                tension: .4
            },
            {
                label: 'Menunggu',
                data: [5, 15, 10, 20, 15, 18, 12],
                borderColor: '#f59e0b',
                borderDash: [5,5],
                tension: .4
            }
        ]
    }
});