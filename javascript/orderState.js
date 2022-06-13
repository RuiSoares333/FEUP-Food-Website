function attachChangeStateEvent() {
    for(button of document.querySelectorAll('article > select')){
        button.addEventListener('change', async function(e){
            const data = new FormData();
            data.append("state", this.value);
            data.append("id", this.parentElement.dataset.id);

            const response = await fetch("../api/api_change_state.php", {
                method: "POST",
                body: data,
            });

            if(response.status >= 200 && response.status < 300 && this.value === "delivered"){
                section = button.parentElement.parentElement;
                this.parentElement.remove();
                if(!section.querySelector('article')){
                    element = document.createElement('h5');
                    element.textContent = "no pending orders";
                    section.appendChild(element);
                }
            }
        })
    }
}

attachChangeStateEvent();