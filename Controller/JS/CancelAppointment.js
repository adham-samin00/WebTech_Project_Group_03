function CancelAppointment(appointment_id, btn) {
    if (!confirm("Are you sure you want to cancel this appointment?"))
        {
            return;
        }
         let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
             if (response.ok)
                {   let row   = btn.closest("tr");
                    let badge = row.querySelector(".status-tag");
                    badge.textContent = "Cancelled";
                    badge.className   = "status-tag tag-cancelled";
                    btn.remove();
                }
            else
                {
                    alert("Could not cancel: " + response.message);
                }
        }
    };
      xhttp.open("POST", "../Controller/Application/CancelAppointment.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify({ appointment_id: appointment_id }));
}