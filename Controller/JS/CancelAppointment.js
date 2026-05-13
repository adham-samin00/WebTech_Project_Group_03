function CancelAppointment(appointment_id, btn) {
    if (!confirm("Are you sure you want to cancel this appointment?"))
        {
            return;
        }
         let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);