function attachCategoryDialogEvents() {
    const categoryButton = document.querySelector('button#categories');
    const dialog = document.getElementById('myDialog');
    const categoryButtonClose = dialog.querySelector('button');

    categoryButton.addEventListener('click', function () {
        dialog.show();
    });
    categoryButtonClose.addEventListener('click', function () {
        dialog.close();
    });

    document.addEventListener('click', function (e){
        if(dialog.open && !dialog.contains(e.target) && !categoryButton.contains(e.target)){
            closeDialog();
        }
    })
}



attachCategoryDialogEvents();