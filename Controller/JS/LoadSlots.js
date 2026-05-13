function LoadSlots(dateStr, clickedBtn) {
   
    let allBtns = document.querySelectorAll(".date-btn");
    allBtns.forEach(function (btn) {
        btn.classList.remove("date-btn-active");
    });
    clickedBtn.classList.add("date-btn-active");
 
    document.getElementById("selected_date").value = dateStr;

    document.getElementById("selected_time").value = "";
    document.getElementById("show-time").value     = "";