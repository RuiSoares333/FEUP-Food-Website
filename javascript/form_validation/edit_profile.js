function attachValidationEvents(){
    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const phone = document.getElementById("phone");
    const address = document.getElementById("address");

    nameEvent(name);
    emailEvent(email);
    phoneEvent(phone);
    addressEvent(address);
}

function nameEvent(name){
    name.addEventListener("input", function () {
        input = name.value;
        warning = name.nextElementSibling;
        if(/[<>"')(;\/#&]/.test(input.trim())){
            warning.textContent = "invalid characters detected";
        }
        else if(input.trim().length > 14){
            warning.textContent = "name can't have more than 14 characters";
        }
        else {
            warning.textContent = "";
        }
    })
}

function emailEvent(email){
    email.addEventListener("input", async function () {
        input = email.value;
        warning = email.nextElementSibling;
        if(!/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(input.trim())){
            warning.textContent = "email must be of type example@email.com";
        }
        else {
            const data = new FormData();
            data.append("email" ,input.trim());

            const response = await fetch("../api/form_validation/api_change_email.php", {
                method: "POST",
                body: data,
            });

            if(await response.json()){
                warning.textContent = "email is taken";
            }
            else{
                warning.textContent = "";
            }

        }
    });
}

function phoneEvent(phone) {
    phone.addEventListener("input", async function() {
        input = phone.value;
        warning = phone.nextElementSibling;
        if(!/^(?:9[1-36]\d|2[12]\d|2[35][1-689]|24[1-59]|26[1-35689]|27[1-9]|28[1-69]|29[1256])\d{6}$/.test(input.trim())){
            warning.textContent = "invalid phone number";
        }
        else {
            const data = new FormData();
            data.append("phone" ,input.trim());

            const response = await fetch("../api/form_validation/api_change_phone.php", {
                method: "POST",
                body: data,
            });    
            
            if(await response.json()){
                warning.textContent = "phone number is taken";
            }
            else {
                warning.textContent = "";
            }
        }
    });
}

function addressEvent(address){
    address.addEventListener("input", function () {
        input = address.value;
        warning = address.nextElementSibling;
        if(/[<>"')(;\/#&]/.test(input.trim())){
            warning.textContent = "non-alphanumeric characters aren't allowed";
        }
        else {
            warning.textContent = "";
        }
    });
}

attachValidationEvents();

function validateForm(){
    const form = document.forms["edit_profile"];
    const name = form["name"].value.trim();
    const email = form["email"].value.trim();
    const phone = form["phone"].value.trim();
    const address = form["address"].value.trim();

    if(name === ""){
        alert("Please enter a name");
        return 0;
    }
    if(email === ""){
        alert("Please enter an email");
        return false;
    }
    if(phone === ""){
        alert("Please enter a phone number");
        return false;
    }
    if(address === ""){
        alert("Please enter an address");
        return false;
    }
    if(/[<>"')(;\/#&]/.test(name)){
        alert("invalid characters detected in name");
        return false;
    }
    if(name > 14){
        alert("name is too long (maximum is 14 characters");
        return false;
    }
    if(!/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)){
        alert("please enter a valid email");
        return false;
    }
    if(!/^(?:9[1-36]\d|2[12]\d|2[35][1-689]|24[1-59]|26[1-35689]|27[1-9]|28[1-69]|29[1256])\d{6}$/.test(phone)){
        alert("please enter a valid phone number");
        return false;
    }
    if(/[<>"')(;\/#&]/.test(address)){
        alert("invalid characters detected in address");
        return false;
    }
    return true;
}