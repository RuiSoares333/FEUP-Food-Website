const categoryButton = document.querySelector('button#categories');
const dialog = document.getElementById('myDialog');

categoryButton.addEventListener('click', showDialog);

const categoryButtonClose = document.querySelector('dialog button');

categoryButtonClose.addEventListener('click', closeDialog);

function showDialog() {
    dialog.show();
}

function closeDialog() {
    dialog.close();
}

document.addEventListener('click', function (){
    if(dialog.open && !dialog.contains(event.target) && !categoryButton.contains(event.target)){
        closeDialog();
    }
})