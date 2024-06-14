const alertShow = document.getElementById("alert");

function showAlert(message) {
    if (alertShow) {
        // const alertBootstrap = bootstrap.Toast.getOrCreateInstance(alertShow);
        var html =
            '<div class="alert alert-danger d-flex align-items-center" id="alert" role="alert"><i class="bi bi-exclamation-triangle-fill"></i><div  style="margin-left: 10px">';
        html += message;
        html += "</div></div>";
        document.querySelector("#alert").innerHTML = html;

        // alertShow.style.display = "block";
        // alertBootstrap.show();
    }
}
