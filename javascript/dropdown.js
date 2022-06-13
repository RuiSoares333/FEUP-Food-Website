function attachDropdownViewClick(){
    const profilePic = document.querySelector('.dropdown > img');
    const dropdownContent = document.querySelector('.dropdown-content');
    
    function showDropdown(){
        dropdownContent.style.display = 'block';
    }
    
    function hideDropdown(){
        dropdownContent.style.display = 'none';
    }

    profilePic.onclick = function(e){
        if(dropdownContent.style.display === 'none'){
            showDropdown();
        }
        else{
            hideDropdown();
        }
    }
}

attachDropdownViewClick();
