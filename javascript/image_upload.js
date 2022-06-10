const imageButton = document.querySelectorAll('#upload > button:nth-child(2)');

for(const button of imageButton){
    button.addEventListener('click', function (){
        var upload = document.getElementById('imgupload');
        upload.onchange = function () {this.form.submit()};
        upload.click();
    });    
}
