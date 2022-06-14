const carousel = document.querySelector('.carousel');
const slider = document.querySelector('.slider');

const next = document.querySelector('.next');
const prev = document.querySelector('.prev');
let direction;

next.addEventListener('click', function() {
    var width60 = window.matchMedia("(max-width: 60em)");
    var width30 = window.matchMedia("(max-width: 30em)");

    direction = -1;
    carousel.style.justifyContent = 'flex-start';

    if(width30.matches){
        slider.style.transform = 'translate(-6.75%)';  
    } else if(width60.matches){
        slider.style.transform = 'translate(-5%)';  
    } else{
        slider.style.transform = 'translate(-4%)';  
    }
});

prev.addEventListener('click', function() {
    var width60 = window.matchMedia("(max-width: 60em)");
    var width30 = window.matchMedia("(max-width: 30em)");

    if (direction === -1) {
        direction = 1;
        slider.appendChild(slider.firstElementChild);
    }
    carousel.style.justifyContent = 'flex-end';    


    if(width30.matches){
        slider.style.transform = 'translate(6.75%)';  
    } else if(width60.matches){
        slider.style.transform = 'translate(5%)';  
    } else{
        slider.style.transform = 'translate(4%)';  
    }
});

slider.addEventListener('transitionend', function() {
  // get the last element and append it to the front
  
  if (direction === 1) {
    slider.prepend(slider.lastElementChild);
  } else {
    slider.appendChild(slider.firstElementChild);
  }
  
  slider.style.transition = 'none';
  slider.style.transform = 'translate(0)';
  setTimeout(() => {
    slider.style.transition = 'all 0.5s';
  })
}, false);