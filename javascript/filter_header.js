function attachFilterEvent(){
    const filterButton = document.getElementById('filter');
    const filterDialog = document.getElementById('filterDialog');
    const filterButtonClose = filterDialog.querySelector('button');

    filterButton.addEventListener('click', function () {
        filterDialog.showModal();
    });

    filterButtonClose.addEventListener('click', function () {
        filterDialog.close();
    });
}

attachFilterEvent();