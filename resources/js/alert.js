import toastr from "toastr";
import "toastr/build/toastr.min.css";

window.toastr = toastr;

toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: 5000,
};

window.showSuccess = (msg) => toastr.success(msg);
window.showError = (msg) => toastr.error(msg);
window.showInfo = (msg) => toastr.info(msg);
window.showWarning = (msg) => toastr.warning(msg);