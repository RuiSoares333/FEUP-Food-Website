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
            
            const code = await response.json();

            this.classList.remove("checked");

            if(code.statusCode == 201)
                alert("SERVER ERROR!");
            else
                this.classList.toggle("checked");
        });
    }
}


attachFavoriteDishEvents();