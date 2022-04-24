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

// Continue service
document.querySelectorAll(".with-cont-conf").forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        const form = button.closest("form");

        Swal.fire({
            title: "Warning!",
            text: "Service akan dilanjutkan berdasarkan perkiraan. Bisa diedit nanti.",
            icon: "warning",
            confirmButtonText: "Lanjut",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonColor: "#b51919",
        }).then((res) => {
            if (res.isConfirmed) {
                form.submit();
            }
        });
    });
});

// sidebar interaction
const sidebarToggler = document.getElementById("sidebar-toggler");
if (sidebarToggler) {
    sidebarToggler.addEventListener("click", (e) => {
        console.log("fag");

        const sidebar = document.getElementById("main-sidebar");
        const mainContent = document.getElementById("main-content");
        sidebar.classList.toggle("sidebar--closed");
        mainContent.classList.toggle("main-content--full");
    });
}
