function attachChangePasswordEvent(){
    const oldPassword = document.getElementById('oldPassword');
    const newPassword = document.getElementById('newPassword');

    newPassword.addEventListener('input', function(){
        warning = newPassword.nextElementSibling;
        if(newPassword.trim().length < 9){
            warning.textContent = "new password is too short";
        }
        if(oldPassword.value == newPassword.value){
            warning.textContent = "new password can't be the same as old password";
        }
        else{
            warning.textContent = "";
        }
    })
}

attachChangePasswordEvent();