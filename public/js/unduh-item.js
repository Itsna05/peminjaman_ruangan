document.addEventListener('DOMContentLoaded', function () {
    const unduhStack = document.getElementById('unduhToggle');

    if (!unduhStack) {
        console.error('Unduh stack tidak ditemukan');
        return;
    }

    unduhStack.addEventListener('click', function (e) {
        e.stopPropagation();
        unduhStack.classList.toggle('active');
    });

    document.addEventListener('click', function () {
        unduhStack.classList.remove('active');
    });
});
