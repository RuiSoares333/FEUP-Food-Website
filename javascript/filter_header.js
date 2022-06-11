const filterButton = document.querySelector('button#filter');
const filterDialog = document.getElementById('filterDialog');
const filterButtonClose = document.querySelector('#filterDialog button');

filterButton.addEventListener('click', showDialog);
filterButtonClose.addEventListener('click', closeDialog);

function showDialog() {
    filterDialog.showModal();
}

function closeDialog() {
    filterDialog.close();
}

document.addEventListener('click', function(){
    if(filterDialog.open && filterDialog.contains(event.target) && filterButton.contains(event.target)) {
        closeDialog();
    }
})