const reviews = document.querySelectorAll('#reviews > article');

for(const review of reviews){
    const respondButton = review.getElementsByClassName('review_response');

    if(respondButton.length === 0)
        continue;

    const form = review.querySelector('form');
    const cancelButton = form.querySelector('button:nth-child(4)');
    const submitButton = form.querySelector('button:nth-child(3)');

    form.style.display = 'none';

    respondButton.item(0).addEventListener('click', function (){
        this.style.display = 'none';
        form.style.display = 'block';
    })

    cancelButton.addEventListener('click', function (){
        form.style.display = 'none';
        respondButton.item(0).style.display = 'block';
    })

    submitButton.addEventListener('click', function (){
        let date = Math.round((new Date()).getTime() / 1000);
        form.querySelector('input').value = date;
    })
}

const submit = document.getElementById('submit');

if(submit !== null){
    submit.addEventListener('click', function (){
        let date = Math.round((new Date()).getTime() / 1000);
        document.querySelector('#newReview > form > input').value = date;
    })
}