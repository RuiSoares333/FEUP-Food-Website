function attachValidationEvents(){
    const name = document.getElementById("name");;
    const phone = document.getElementById("phone");
    const address = document.getElementById("address");

    nameEvent(name);
    phoneEvent(phone);
    addressEvent(address);
}   

function nameEvent(name){
    name.addEventListener("input", function () {
        input = name.value;
        warning = name.nextElementSibling;
        if(/[<>\"')(;\/#&]/.test(input.trim())){
            warning.textContent = "non-alphanumeric characters aren't allowed";
        }
        else if(input.trim().length > 50){
            warning.textContent = "name can't have more than 50 characters";
        }
        else {
            warning.textContent = "";
        }
    })
}

function phoneEvent(phone) {
    phone.addEventListener("input", async function() {
        input = phone.value;
        warning = phone.nextElementSibling;
        if(!/^(?:9[1-36]\d|2[12]\d|2[35][1-689]|24[1-59]|26[1-35689]|27[1-9]|28[1-69]|29[1256])\d{6}$/.test(input.trim())){
            warning.textContent = "invalid phone number";
        }
        else {

            console.log(escapeHtml(new URLSearchParams(document.location.search).get("id")));
            const data = new FormData();
            data.append("phone" ,input.trim());
            data.append("id", parseInt(escapeHtml(new URLSearchParams(document.location.search).get("id")), 10));

            const response = await fetch("../api/form_validation/api_change_phone_restaurant.php", {
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
        if(/[<>\"')(;\/#&]/.test(input.trim())){
            warning.textContent = "non-alphanumeric characters aren't allowed";
        }
        else {
            warning.textContent = "";
        }
    });
}

attachValidationEvents();

const entityMap = {
    "&" : "&amp;",
    "<" : "&lt;",
    ">" : "&gt;",
    '"' : "&quot;",
    "'" : "&#39;",
    "/" : "&#x2F;"
  };
  
function escapeHtml(string) {
  return String(string).replace(/[&<>"'\/]/g, function (s) {
    return entityMap[s];
  });
}