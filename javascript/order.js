function attachOrderEvent() {
    const button = document.querySelector('#cart button');

    button.addEventListener('click', async function () {
        const rows = document.querySelectorAll('#cart table tbody > tr');
        if(rows.length > 0) {
            const restaurant = parseInt(escapeHtml(new URLSearchParams(document.location.search).get("id")), 10);

            const data = new FormData();
            data.append("restaurant", restaurant);
    
            let json = {};
    
            for(const row of rows) {
                json[row.dataset.id] = row.querySelector('input').value;
            }
    
            data.append("dishes", JSON.stringify(json));
    
            const response = await fetch("../api/api_submit_order.php", {
                method: "POST",
                body : data,
            });
            
            if(response.status >= 200 && response.status < 300) {
                document.location.assign('../pages/orders.php');
            }
            
        }
    })
}

const entityMap = {
    "&" : "&amp;",
    "<" : "&lt;",
    ">" : "&gt;",
    '"' : "&quot;",
    "'" : "&#39;",
    "/" : "&#x2F;"
  };
  
function escapeHtml(string) {
  return String(string).replace(/[&<>"'\/]/g, function (s) {
    return entityMap[s];
  });
}

attachOrderEvent();