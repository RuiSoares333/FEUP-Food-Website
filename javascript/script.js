const searchRestaurant = document.querySelector('.sort button');
if(searchRestaurant){
    searchRestaurant.addEventListener('click', async function() {
        const response = await fetch('api_artists.php');
        const restaurants = await response.json();

        const section = document.querySelector('#mainDiv .search');
        section.innerHTML = '';

        for(const restaurant of restaurants){
            const article = document.createElement('article');
            const img = document.createElement('img');
            img.src = 'https://picsum.photos/200?' + restaurant.id  
            const link = document.createElement('a');
            link.href = "restaurant.php?id = " + restaurant.id
            link.textContent = restaurant.name;
            article.appendChild(img);
            article.appendChild(link);
            section.appendChild(article);
        }
    })
}