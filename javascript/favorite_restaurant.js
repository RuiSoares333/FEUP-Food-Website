const buttons = document.getElementsByClassName('favoriteRestaurant');

for(const button in buttons) {
    button.addEventListener('click', function () {
        console.log(button.checked);
    })
}

