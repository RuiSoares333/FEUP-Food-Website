function attachExpandEvent() {
    for(const button of document.querySelectorAll('article > a')){
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const div = button.parentElement.querySelector('div');
            console.log(div.style.display);

            if(div.style.display === 'none' || div.style.display === ''){
                div.style.display = 'flex';
                button.innerHTML = '∧';
            }
            else {
                div.style.display = 'none';
                button.innerHTML = '∨';
            }        
        })
    }
}

attachExpandEvent();