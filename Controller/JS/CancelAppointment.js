function CancelAppointment(appointment_id, btn) {
    if (!confirm("Are you sure you want to cancel this appointment?"))
        {
            return;
        }