function CheckUserName() {
    let email = document.getElementById("email").value;

    if (email.length === 0) {
        document.getElementById("email-msg").innerHTML = "";
        return;
    }

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () 
    {
        if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById("email-msg").innerHTML = this.responseText;
            }
    };

    xhttp.open("GET", "../Controller/Application/CheckUserName.php?email=" + email, true);
    xhttp.send();
}
