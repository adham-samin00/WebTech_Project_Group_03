function FilterDoctors(selectBox) {
    let specialization_id = selectBox.value;

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("doctors-list").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "../Controller/Application/FilterDoctors.php?specialization_id=" + specialization_id, true);
    xhttp.send();
}