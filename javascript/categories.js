function attachCategoryDialogEvents() {
    const categoryButton = document.querySelector('button#categories');
    const dialog = document.getElementById('myDialog');
    const categoryButtonClose = dialog.querySelector('button');

    categoryButton.addEventListener('click', function () {
        dialog.show();
        dialog.style.display = "flex";
    });
    categoryButtonClose.addEventListener('click', function () {
        dialog.close();
        dialog.style.display = "none";
    });

    document.addEventListener('click', function (e){
        if(dialog.open && !dialog.contains(e.target) && !categoryButton.contains(e.target)){
            dialog.close();
            dialog.style.display = "none";
        }
    })
}



attachCategoryDialogEvents();