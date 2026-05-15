function UpdateStatus(appointment_id, new_status, btn) {
    if (!confirm("Mark this appointment as " + new_status + "?"))
        {
            return;
        }

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);

            if (response.ok)
                {
                    let row   = btn.closest("tr");
                    let badge = row.querySelector(".status-tag");

                    badge.textContent = response.new_status;
                    badge.className   = "status-tag tag-" + response.new_status.toLowerCase().replace("-", "");

                    let actionCell = row.querySelector(".action-btns");
                    if (actionCell)
                        {
                            actionCell.innerHTML = "-";
                        }
                }
            else
                {
                    alert("Error: " + response.message);
                }
        }
    };

    xhttp.open("POST", "../Controller/Application/UpdateStatus.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify({ appointment_id: appointment_id, status: new_status }));
}
