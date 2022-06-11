const categoryButton = document.querySelector('button#categories');
const dialog = document.getElementById('myDialog');
const categoryButtonClose = document.querySelector('#myDialog button');

categoryButton.addEventListener('click', showDialog);
categoryButtonClose.addEventListener('click', closeDialog);

function showDialog() {
    dialog.showModal();
}

function closeDialog() {
    dialog.close();
}

document.addEventListener('click', function (){
    if(dialog.open && !dialog.contains(event.target) && !categoryButton.contains(event.target)){
        closeDialog();
    }
})
