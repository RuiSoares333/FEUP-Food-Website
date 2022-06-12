function attachOrderEvent() {
    const button = document.querySelector('#cart button');

    button.addEventListener('click', function () {
        const total = parseInt(document.querySelector('#cart table tfoot th:last-child').textContent, 10)
        const restuarant = parseInt(new URLSearchParams(document.location.search).get("id"), 10);

        const data = new FormData();
        data.append(restuarant);
        data.append(total);

        const dishes = [];

        for(const row of document.querySelectorAll('#cart table > tr')) {
            const dish = [];
            dish[0] = row.dataset.id;
            dish[1] = row.querySelector('input').value;
            dishes.push(dish);
        }

        data.append(dishes);

        const response = await fetch("../api/api_submit_order.php", {
            method: "POST",
            body : data,
        });

        const code = await response.json();

        if(code.statusCode === 201)
            alert("ERROR SUBMITING ORDER");
        else
            this.location.href ="../pages/orders.php";
    })

}