function attachExpandEvent() {
    for(const button of document.querySelectorAll('article > a')){
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const div = button.parentElement.querySelector('div');

            if(div.style.display == 'none'){
                div.style.display = 'block';
                button.innerHTML = 'Show less';
            }
            else {
                div.style.display = 'none';
                button.innerHTML = 'Show more';
            }        
        })
    }
}

attachExpandEvent();