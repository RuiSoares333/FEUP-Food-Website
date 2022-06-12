function attachResponseEvents() {
    for(const review of document.querySelectorAll('#reviews > article')){
        const respondButton = review.querySelector('.review_response');

        if(respondButton){
            const form = review.querySelector('form');
            const cancelButton = form.querySelector('button:nth-child(4)');
            const submitButton = form.querySelector('button:nth-child(3)');

            form.style.display = 'none';

            respondButton.addEventListener('click', function () {
                toggleForm(form);
                toggleButton(respondButton);
            });

            cancelButton.addEventListener('click', function () {
                toggleForm(form);
                toggleButton(respondButton);
            })

            submitButton.addEventListener('click', function () {
                setDate(form);
            })            
        }
    }
}

function toggleForm(form) {
    if(form.style.display === 'none')
        form.style.display = 'block';
    else
        form.style.display = 'none';
}

function toggleButton(button) {
    if(button.style.display === 'none')
        button.style.display = 'block';
    else
        button.style.display = 'none';
}

function setDate(form) {
    let date = Math.round((new Date()).getTime() / 1000);
    form.querySelector('input.date').value = date;
}

function attachReviewEvent(){
    const submit = document.getElementById('submit');
    if(submit)
        submit.addEventListener('click', function () {
            setDate(submit.parentElement);
        })
}

attachReviewEvent();

attachResponseEvents();