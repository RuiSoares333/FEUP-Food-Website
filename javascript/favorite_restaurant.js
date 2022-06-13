function attachFavoriteRestaurantEvents(){
    for(const button of document.querySelectorAll('.miniPreview > button')){
        button.addEventListener('click', async function (){
            const data = new FormData();
            data.append("restaurant", this.parentElement.dataset.id);
            data.append("add", this.classList.contains("checked") ? 0 : 1);
    
            const response = await fetch("../api/api_favorite_restaurants.php", {
                method: "POST",
                body : data,
            });
    
            const code = await response.json();
    
            if(code.statusCode === 201)
                alert("SERVER ERROR!");
            else
                this.classList.toggle("checked");
        });
    }
}

attachFavoriteRestaurantEvents();

const miniPreviews = document.getElementsByClassName("miniPreview");

for(const element of miniPreviews){
  element.addEventListener('mouseover', function(){
    this.querySelector("button").style.display = "block";
  })
}

for(const element of miniPreviews){
  element.addEventListener('mouseout', function(){
    this.querySelector("button").style.display = "none";
  })
}