const pfpButton = document.getElementById('upload');
pfpButton.addEventListener('click', function (){
    var upload = document.getElementById('imgupload');
    upload.onchange = function () {this.form.submit()};
    upload.click();
});