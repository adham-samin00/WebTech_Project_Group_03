function toggleActive(userId, btn) 
{
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () 
    {
        if (this.readyState == 4 && this.status == 200) 
            {   
                let response = JSON.parse(this.responseText);

                if(response.ok)                    
                    {
                        let row   = btn.closest("tr");
                        let badge = row.querySelector(".status-badge");                       

                        if(response.is_active == 1) 
                            {
                                btn.textContent   = "Deactivate";
                                btn.className     = "btn-deactivate";
                                badge.textContent = "Active";
                                badge.className   = "status-badge active";
                            }                         
                        else 
                            {
                                btn.textContent   = "Activate";
                                btn.className     = "btn-activate";
                                badge.textContent = "Inactive";
                                badge.className   = "status-badge inactive";
                            }
                    } 

                    else 
                        {
                            alert("Error: " + response.message);
                        }
            }
    };

    xhttp.open("POST", "../Controller/Application/ToggleActive.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify({ user_id: userId }));
}
