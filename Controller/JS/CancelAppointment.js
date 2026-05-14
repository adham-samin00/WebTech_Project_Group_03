function CancelAppointment(appointment_id, btn) {
    if (!confirm("Are you sure you want to cancel this appointment?")) {
        return;
    }

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);

            if (response.ok) {
                let row = btn.closest("tr");
                let cancelledRow = row.cloneNode(true);
                let badge = cancelledRow.querySelector(".status-tag");
                badge.textContent = "Cancelled";
                badge.className = "status-tag tag-cancelled";
                let actionCell = cancelledRow.querySelector("td:last-child");
                if (actionCell) actionCell.remove();
                row.remove();
                let cancelledSection = document.querySelector(".title-cancelled");
                if (cancelledSection) {
                    let cancelledTable = cancelledSection
                        .closest(".appt-section")
                        .querySelector("tbody");

                    if (cancelledTable) {
                        cancelledTable.appendChild(cancelledRow);
                    }
                }

                updateGroupCount("title-pending");
                updateGroupCount("title-cancelled");

            } else {
                alert("Could not cancel: " + response.message);
            }
        }
    };

    xhttp.open("POST", "../Controller/Application/CancelAppointment.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify({ appointment_id: appointment_id }));
}

function updateGroupCount(titleClass) {
    let section = document.querySelector("." + titleClass);
    if (!section) return;

    let tbody = section.closest(".appt-section").querySelector("tbody");
    let count = tbody ? tbody.querySelectorAll("tr").length : 0;
    section.textContent = section.textContent.replace(/\(\d+\)/, "(" + count + ")");
}