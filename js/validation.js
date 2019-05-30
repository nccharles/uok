const first_name = document.querySelector("#fname"); 
const last_name = document.querySelector("#lname");              
const email = document.querySelector("#email");    
const phone = document.querySelector("#phone");  
const role = document.querySelector("#type"); 
const stafForm=()=>                                    
{ 
    console.log(first_name.value)
    if (first_name.value == "")                                  
    { 
        window.alert("Please enter first name."); 
        first_name.focus(); 
    } 
   
    if (last_name.value == "")                               
    { 
        window.alert("Please enter last name."); 
        last_name.focus(); 
    } 
       
    if (email.value == "")                                   
    { 
        window.alert("Please enter a valid e-mail address."); 
        email.focus(); 
    } 
   
    if (email.value.indexOf("@", 0) < 0)                 
    { 
        window.alert("Please enter a valid e-mail address."); 
        email.focus(); 
    } 
   
    if (email.value.indexOf(".", 0) < 0)                 
    { 
        window.alert("Please enter a valid e-mail address."); 
        email.focus(); 
    } 
   
    if (phone.value == "")                           
    { 
        window.alert("Please enter telephone number."); 
        phone.focus(); 
    } 
   
    if (role.selectedIndex < 1)                  
    { 
        alert("Please Select staff title."); 
        role.focus(); 
    } 
   
}