function loadDoctorStats(doctorid){
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200)
        {
            document.getElementById("appt-count").innerHTML=this.responseText;
        }
        else{
            document.getElementById("appt-count").innerHTML=this.status;
        }
    }
    xhttp.open("GET", "../Controller/api/getDoctorStats.php?id = "+doctorid, true);
    xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
    xhttp.send();
}