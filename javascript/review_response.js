//const respondButtons = document.querySelectorAll('#review_response');
//const forms = document.querySelectorAll('#reviews > article > form');
//const cancelButtons = document.querySelectorAll('#reviews > article > form > button:nth-child(4)');
//
//for(const form of forms){
//    form.style.display = 'none';
//}
//
//
//for(const respond of respondButtons){
//    respond.addEventListener('click', function (){
//        this.style.display = 'none';
//        this.querySelector
//    })
//}
//
//
//cancelButton.addEventListener('click', function (){
//    respondButton.style.display = 'block';
//    form.style.display = 'none';
//})
//
//function currentTime(element) {
//    var date = Math.round((new Date()).getTime() / 1000);
//    element.value = date;
//}
//
//const responseSubmit = document.querySelectorAll('#reviews > article > form > button:nth-child(3)');
//const reviewSubmit = document.querySelector('#submit');

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
        form.style.display = 'flex';
    })

    cancelButton.addEventListener('click', function (){
        form.style.display = 'none';
        respondButton.item(0).style.display = 'block';
    })

    submitButton.addEventListener('click', function (){
        var date = Math.round((new Date()).getTime() / 1000);
        form.querySelector('input').value = date;
    })
}

const submit = document.getElementById('submit');

if(submit !== null){
    submit.addEventListener('click', function (){
        var date = Math.round((new Date()).getTime() / 1000);
        document.querySelector('#newReview > form > input').value = date;
    })
}