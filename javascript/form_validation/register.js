function attachValidationEvents(){
    const username = document.getElementById("username");
    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const password2 = document.getElementById("password2");
    const phone = document.getElementById("phone");
    const address = document.getElementById("address");
    const submit = document.getElementById("continue");

    usernameEvent(username);
    nameEvent(name);
    emailEvent(email);
    passwordEvent(password);
    password2Event(password, password2);
    phoneEvent(phone);
    addressEvent(address);
}   

function usernameEvent(username){
    username.addEventListener("input", async function () {
        input = username.value;
        warning = username.nextSibling.nextSibling;
        if(!/^[\w\s]{0,14}$/.test(input.trim())){
            warning.textContent = "non-alphanumeric characters aren't allowed";
        }
        else{
            const data = new FormData();
            data.append("username" ,input.trim());

            response = await fetch("../api/form_validation/api_username.php", {
                method: "POST",
                body: data,
            });

            if(await response.json()){
                warning.textContent = "username is taken";
            }
            else{
                warning.textContent = "";
            }
        }
    });
}

function nameEvent(name){
    name.addEventListener("input", function () {
        input = name.value;
        warning = name.nextSibling.nextSibling;
        if(!/^[\w\s]{0,14}$/.test(input.trim())){
            warning.textContent = "non-alphanumeric characters aren't allowed";
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
        warning = email.nextSibling.nextSibling;
        if(!/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(input.trim())){
            warning.textContent = "email must be of type example@email.com";
        }
        else {
            const data = new FormData();
            data.append("email" ,input.trim());

            response = await fetch("../api/form_validation/api_email.php", {
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

function passwordEvent(password){
    password.addEventListener("input", function (){
        input = password.value;
        warning = password.nextSibling.nextSibling;
        if(input.trim().length < 9){
            warning.textContent = "password should have at least 9 characters";
        }
        else {
            warning.textContent = "";
        }
    });
}

function password2Event(password, password2){
    password2.addEventListener("input", function() {
        input = password.value;
        input2 = password2.value;
        warning = password2.nextSibling.nextSibling;
        if(input.trim() !== input2.trim()){
            warning.textContent = "passwords don't match";
        }
        else{
            warning.textContent = "";
        }
    })
}

function phoneEvent(phone) {
    phone.addEventListener("input", async function() {
        input = phone.value;
        warning = phone.nextSibling.nextSibling;
        if(!/^(?:9[1-36]\d|2[12]\d|2[35][1-689]|24[1-59]|26[1-35689]|27[1-9]|28[1-69]|29[1256])\d{6}$/.test(input.trim())){
            warning.textContent = "invalid phone number";
        }
        else {
            const data = new FormData();
            data.append("phone" ,input.trim());

            response = await fetch("../api/form_validation/api_email.php", {
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
        warning = address.nextSibling.nextSibling;
        if(!/^[\w\s]{0,14}$/.test(input.trim())){
            warning.textContent = "non-alphanumeric characters aren't allowed";
        }
        else {
            warning.textContent = "";
        }
    });
}

function submitEvent(submit){
    submit.addEventListener("submit", function(e){
        form = document.forms["registerForm"];
        if(form["username"] == ""){
            alert("username must be filled out");
            e.preventDefault();
        }
    })
}

attachValidationEvents();