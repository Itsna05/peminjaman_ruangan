document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("detailModal");
    const confirmModal = document.getElementById("confirmModal");

    // ⛔ JIKA MODAL TIDAK ADA → STOP JS INI
    if (!modal) return;

    const openButtons = document.querySelectorAll(".btn-open-modal");
    const closeButton = modal.querySelector(".modal-close");

    let currentRow = null;
    let actionType = null;

    /* =====================
       BUKA MODAL DETAIL
    ===================== */
    openButtons.forEach(btn => {
        btn.addEventListener("click", function () {
            currentRow = this.closest("tr");
            modal.style.display = "flex";
        });
    });

    /* =====================
       TUTUP MODAL DETAIL
    ===================== */
    if (closeButton) {
        closeButton.addEventListener("click", () => {
            modal.style.display = "none";
        });
    }

    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    /* =====================
       MODAL KONFIRMASI
    ===================== */
    if (!confirmModal) return;

    const btnSetujui = document.querySelector(".btn-approve");
    const btnTolak = document.querySelector(".btn-reject");
    const btnConfirmYes = document.querySelector(".btn-confirm-yes");
    const btnConfirmNo = document.querySelector(".btn-confirm-no");

    btnSetujui?.addEventListener("click", () => {
        actionType = "setujui";
        confirmModal.style.display = "flex";
    });

    btnTolak?.addEventListener("click", () => {
        actionType = "tolak";
        confirmModal.style.display = "flex";
    });

    btnConfirmNo?.addEventListener("click", () => {
        confirmModal.style.display = "none";
    });

    btnConfirmYes?.addEventListener("click", () => {
        if (!currentRow) return;

        const statusBadge = currentRow.querySelector(".badge-status");
        const actionButton = currentRow.querySelector(".btn-edit");

        if (actionType === "setujui") {
            statusBadge.textContent = "Disetujui";
            statusBadge.className = "badge-status disetujui";
        }

        if (actionType === "tolak") {
            statusBadge.textContent = "Ditolak";
            statusBadge.className = "badge-status ditolak";
        }

        actionButton?.classList.add("disabled");
        actionButton?.setAttribute("disabled", true);

        confirmModal.style.display = "none";
        modal.style.display = "none";

        currentRow = null;
        actionType = null;
    });

    confirmModal.addEventListener("click", function (e) {
        if (e.target === confirmModal) {
            confirmModal.style.display = "none";
        }
    });

});

