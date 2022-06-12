function attachImageEvent(){
    for(const button of document.querySelectorAll('#upload > button:nth-child(2)')){
        button.addEventListener('click', function () {
            const upload = document.getElementById('imgupload');

            upload.onchange = function () {this.form.submit()};
            upload.click();
        });
    }
}

attachImageEvent();