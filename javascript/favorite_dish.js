function attachFavoriteDishEvents(){
    for(const button of document.querySelectorAll('.dish > button')){
        button.addEventListener('click', async function(){
            const data = new FormData();
            data.append("dish", this.parentElement.dataset.id);
            data.append("add", this.classList.contains("checked") ? 0 : 1);

            const response = await fetch("../api/api_favorite_dish.php", {
                method: "POST",
                body: data,
            });   
            
            if(response.status >= 200 && response.status < 300){
                this.classList.toggle("checked");
                this.classList.toggle("unchecked");
            }
                
        });
    }
}


attachFavoriteDishEvents();