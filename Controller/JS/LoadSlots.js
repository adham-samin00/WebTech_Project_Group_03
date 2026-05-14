function LoadSlots(dateStr, clickedBtn) {
    let allBtns = document.querySelectorAll(".date-btn");
    allBtns.forEach(btn => btn.classList.remove("date-btn-active"));
    clickedBtn.classList.add("date-btn-active");

    document.getElementById("selected_date").value = dateStr;
    document.getElementById("selected_time").value = "";
    document.getElementById("show-time").value = "";

    let doctor_id = document.getElementById("doctor_id").value;

    document.getElementById("slots-area").innerHTML = "<p class='loading-msg'>Loading slots...</p>";

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("slots-area").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "../Controller/Application/LoadSlots.php?doctor_id=" + doctor_id + "&date=" + dateStr, true);
    xhttp.send();
}
function PickSlot(time, clickedBtn) {
    let allSlots = document.querySelectorAll(".slot-btn");
    allSlots.forEach(function (btn) {
        btn.classList.remove("slot-btn-active");
    });
    clickedBtn.classList.add("slot-btn-active");
    document.getElementById("selected_time").value = time;
    document.getElementById("show-time").value     = time;
}