require("./bootstrap");

import Alpine from "alpinejs";
import Swal from "sweetalert2";

window.Alpine = Alpine;

Alpine.start();

// Delete confirmation
document.querySelectorAll(".with-del-conf").forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        const form = button.closest("form");

        Swal.fire({
            title: "Warning!",
            text: "Apakah anda yakin mau menghapus data ini?",
            icon: "warning",
            confirmButtonText: "Ya",
            showCancelButton: true,
            cancelButtonText: "Tidak",
            confirmButtonColor: "#b51919",
            // customClass: {
            //     confirmButton: "bg-primary",
            // },
        }).then((res) => {
            if (res.isConfirmed) {
                form.submit();
            }
        });
    });
});
