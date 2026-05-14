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

                // Clone the row to move it to the Cancelled table
                let cancelledRow = row.cloneNode(true);

                // Update the badge in the cloned row
                let badge = cancelledRow.querySelector(".status-tag");
                badge.textContent = "Cancelled";
                badge.className = "status-tag tag-cancelled";

                // Remove the Action cell (last td) from the cloned row
                let actionCell = cancelledRow.querySelector("td:last-child");
                if (actionCell) actionCell.remove();

                // Remove the original row from Pending table
                row.remove();

                // Find the Cancelled section's tbody and append the row
                let cancelledSection = document.querySelector(".title-cancelled");
                if (cancelledSection) {
                    let cancelledTable = cancelledSection
                        .closest(".appt-section")
                        .querySelector("tbody");

                    if (cancelledTable) {
                        cancelledTable.appendChild(cancelledRow);
                    }
                }

                // Update Pending count in the group title
                updateGroupCount("title-pending");

                // Update Cancelled count in the group title
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

    // Replace e.g. "Pending (3)" → "Pending (2)"
    section.textContent = section.textContent.replace(/\(\d+\)/, "(" + count + ")");
}