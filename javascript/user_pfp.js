const pfpButton = document.querySelector('#user form > button:nth-child(2)');
pfpButton.addEventListener('click', function (){
    var upload = document.getElementById('imgupload');
    upload.onchange = function () {this.form.submit()};
    upload.click();
});