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


const pfp = document.querySelector('section#user img');
pfp.on('click', function(){
    var input = document.createElement('input');
    input.type = 'file';
    document.querySelector('html body').append(input);
    input.click();
})