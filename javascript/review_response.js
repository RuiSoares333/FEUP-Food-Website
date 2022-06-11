const respondButton = document.getElementById('review_response');
const form = document.querySelector('#reviews > article > form');
const cancelButton = document.querySelector('#reviews > article > form > button:nth-child(3)');

form.style.display = 'none';

respondButton.addEventListener('click', function (){
    this.style.display = 'none';
    form.style.display = 'block';
})

cancelButton.addEventListener('click', function (){
    respondButton.style.display = 'block';
    form.style.display = 'none';
})