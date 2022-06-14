function attachValidationEvents(){
    const name = document.getElementById("name");

    nameEvent(name);
}   

function nameEvent(name){
    name.addEventListener("input", function () {
        input = name.value;
        warning = name.nextElementSibling;
        if(/[<>\"')(;\/#&]/.test(input.trim())){
            warning.textContent = "non-alphanumeric characters aren't allowed";
        }
        else if(input.trim().length > 25){
            warning.textContent = "name can't have more than 25 characters";
        }
        else {
            warning.textContent = "";
        }
    })
}

attachValidationEvents();