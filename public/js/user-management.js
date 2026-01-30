document.addEventListener('DOMContentLoaded', function () {

    const filterBtn = document.querySelector('.user-filter-btn');
    const filterDropdown = document.querySelector('.user-filter-dropdown');

    // ⛔ halaman ini tidak punya filter user
    if (!filterBtn || !filterDropdown) return;

    const filterItems = filterDropdown.querySelectorAll('.filter-item');
    const rows = document.querySelectorAll('.user-table tbody tr');

    /* =========================
       TOGGLE DROPDOWN
    ========================= */
    filterBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        filterDropdown.classList.toggle('d-none');
    });

    // klik di dalam dropdown → jangan nutup
    filterDropdown.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    // klik di luar → nutup
    document.addEventListener('click', function () {
        filterDropdown.classList.add('d-none');
    });

    /* =========================
       FILTER TABLE
    ========================= */
    filterItems.forEach(item => {
        item.addEventListener('click', function () {
            const value = this.dataset.value || '';

            rows.forEach(row => {
                const role = row.dataset.role || '';

                row.style.display =
                    (!value || role === value) ? '' : 'none';
            });

            filterDropdown.classList.add('d-none');
        });
    });

});
