function attachValidationEvents(){
    const name = document.getElementById("name");

    nameEvent(name);
}   

function nameEvent(name){
    name.addEventListener("input", function () {
        input = name.value;
        warning = name.nextElementSibling;
        if(/[<>"')(;\/#&]/.test(input.trim())){
            warning.textContent = "invalid characters detected";
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

function validateForm(){
    const form = document.forms["addDish"];

    const name = form["name"].value.trim();
    const price = form["price"].value.trim();
    const category = form["category"].value.trim();

    if(name === ""){
        alert("Please enter a name");
        return false;
    }
    if(price === ""){
        alert("Please enter a price");
        return false;
    }
    if(category === ""){
        alert("Please choose a category");
        return false;
    }
    if(/[<>"')(;\/#&]/.test(name)){
        alert("invalid characters detected in name");
        return false;
    }
    if(!/[\d]*/.test(price)){
        alert("price should be an integer");
        return false;
    }
    if(/[<>"')(;\/#&]/.test(category)){
        alert("invalid characters detected in category");
        return false;
    }
    return true;
}