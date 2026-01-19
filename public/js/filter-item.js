document.querySelectorAll('.filter-item').forEach(button => {
    button.addEventListener('click', function () {

        const selectedStatus = this.dataset.value;
        const rows = document.querySelectorAll('.status-table tbody tr');

        rows.forEach(row => {
            if (row.dataset.status === selectedStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // tutup dropdown
        document.getElementById('filterDropdown').classList.remove('show');
    });
});