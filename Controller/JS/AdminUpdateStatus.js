function AdminUpdateStatus(appointment_id, new_status, btn) {
    if (!confirm("Change status to " + new_status + "?"))
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
                            if (response.new_status == "Confirmed")
                                {
                                    actionCell.innerHTML =
                                        "<button class='action-cancel' onclick='AdminUpdateStatus(" + appointment_id + ", \"Cancelled\", this)'>Cancel</button>";
                                }
                            else
                                {
                                    actionCell.innerHTML = "-";
                                }
                        }
                }
            else
                {
                    alert("Error: " + response.message);
                }
        }
    };

    xhttp.open("POST", "../Controller/Application/AdminUpdateStatus.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify({ appointment_id: appointment_id, status: new_status }));
}