function attachChangeStateEvent() {
    for(button of document.querySelectorAll('article > select')){
        button.addEventListener('change', async function(e){
            const data = new FormData();
            data.append("state", button.value);
            data.append("id", button.parentElement.dataset.id);

            const response = await fetch("../api/api_change_state.php", {
                method: "POST",
                body: data,
            });
        })
    }
}

attachChangeStateEvent();