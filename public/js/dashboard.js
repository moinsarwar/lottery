document.addEventListener("DOMContentLoaded", function () {
    // success toast
    var successToastEl = document.getElementById('successToast');
    if (successToastEl) {
        var successToast = new bootstrap.Toast(successToastEl, {delay: 5000});
        successToast.show();
    }

    // error toast
    var errorToastEl = document.getElementById('errorToast');
    if (errorToastEl) {
        var errorToast = new bootstrap.Toast(errorToastEl, {delay: 5000});
        errorToast.show();
    }

    // validation errors
    document.querySelectorAll('.toast.text-bg-danger').forEach(toastEl => {
        let toast = new bootstrap.Toast(toastEl, {delay: 5000});
        toast.show();
    });
});
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".viewBtn").forEach(btn => {
        btn.addEventListener("click", function () {
            let id = this.dataset.id;
            let number = this.dataset.number;
            document.getElementById("lotteryId").value = id;
            document.getElementById("editLotteryNumber").value = number;
        });
    });
});
document.getElementById('year').textContent = new Date().getFullYear();
