document.addEventListener('DOMContentLoaded', function () {

    // =========================
    // SEARCH BIDANG PEGAWAI
    // =========================
    const searchBidang = document.getElementById('searchBidang');
    const bidangRows  = document.querySelectorAll('.user-bidang-section tbody tr');

    if (searchBidang) {
        searchBidang.addEventListener('keyup', function () {
            const keyword = this.value.toLowerCase();

            bidangRows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(keyword) ? '' : 'none';
            });
        });
    }

    // =========================
    // SEARCH USER
    // =========================
    const searchUser = document.getElementById('searchUser');
    const userRows  = document.querySelectorAll('.user-section tbody tr');

    if (searchUser) {
        searchUser.addEventListener('keyup', function () {
            const keyword = this.value.toLowerCase();

            userRows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(keyword) ? '' : 'none';
            });
        });
    }

});
