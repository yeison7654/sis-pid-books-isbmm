const base_url = "http://localhost/sis-pid-books-isbmm";
const url_logic = base_url + "/logic/";

function alertas(data) {
    let alertMsj = document.querySelector(".alert");
    let danger = alertMsj.classList.contains("danger");
    let info = alertMsj.classList.contains("info");
    let success = alertMsj.classList.contains("success");
    let hidden = alertMsj.classList.contains("hidden");
    switch (data.type) {
        case "success":
            if (danger) {
                alertMsj.classList.remove("danger");
            }
            if (info) {
                alertMsj.classList.remove("info");
            }
            if (hidden) {
                alertMsj.classList.remove("hidden")
            }
            alertMsj.classList.add("success");
            break;
        case "danger":
            if (success) {
                alertMsj.classList.remove("success");
            }
            if (info) {
                alertMsj.classList.remove("info");
            }
            if (hidden) {
                alertMsj.classList.remove("hidden")
            }
            alertMsj.classList.add("danger");
            break;
        case "info":
            if (success) {
                alertMsj.classList.remove("success");
            }
            if (danger) {
                alertMsj.classList.remove("danger");
            }
            if (hidden) {
                alertMsj.classList.remove("hidden")
            }
            alertMsj.classList.add("info");
            break;
        default:

            break;
    }
}