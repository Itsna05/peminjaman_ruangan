document.addEventListener('DOMContentLoaded', function () {

    /* =========================
       FILTER STATUS (AMAN)
    ========================= */

    const toggle   = document.getElementById('filterToggle');
    const dropdown = document.getElementById('filterDropdown');
    const rows     = document.querySelectorAll('.status-table tbody tr');

    if (toggle && dropdown) {

        // buka / tutup dropdown
        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.classList.toggle('show');
        });

        // klik item filter
        document.querySelectorAll('.filter-item').forEach(item => {
            item.addEventListener('click', function () {

                const selectedStatus = this.dataset.value;

                rows.forEach(row => {
                    const badge = row.querySelector('.badge-status');
                    if (!badge) return;

                    if (!selectedStatus || badge.classList.contains(selectedStatus)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                dropdown.classList.remove('show');
            });
        });

        // klik di luar → dropdown nutup
        document.addEventListener('click', function () {
            dropdown.classList.remove('show');
        });
    }

    /* =========================
       JUMLAH BARIS TABEL (AMAN)
    ========================= */

    const rowsSelect = document.getElementById('rowsSelect');
    const tableBody  = document.getElementById('tableBody');

    if (rowsSelect && tableBody) {
        const tableRows = tableBody.querySelectorAll('tr');

        function updateRows() {
            const limit = parseInt(rowsSelect.value, 10);

            tableRows.forEach((row, index) => {
                row.style.display = index < limit ? '' : 'none';
            });
        }

        // pertama kali load
        updateRows();

        // saat user ganti jumlah baris
        rowsSelect.addEventListener('change', updateRows);
    }

});
