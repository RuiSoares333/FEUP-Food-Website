function attachBuyEvents() {
  for(const button of document.querySelectorAll('#dishes article'))
    button.addEventListener('click', function(e){
      const starButton = button.querySelector('button');

      if(!button.contains(e.target)){
      const id = this.dataset.id;
      const row = document.querySelector(`#cart table tr[data-id="${id}"]`);

      const name = this.querySelector('p:nth-child(2)').textContent;
      const price = this.querySelector('p:nth-child(3)').textContent;
      const quantity = document.createElement('input');
      quantity.type = 'number';
      quantity.value = 1;

      if(!row) addRow(id, name, price, quantity);

      updateTotal();        
      }
    });
}

function addRow(id, name, price, quantity) {
  const table = document.querySelector('#cart table');
  const row = document.createElement('tr');
  row.setAttribute('data-id', id);

  const nameCell = document.createElement('td');
  nameCell.textContent = name;

  const quantityCell = document.createElement('td');
  quantityCell.appendChild(quantity);

  const priceCell = document.createElement('td');
  priceCell.textContent = parseInt(price, 10) * quantity.value;

  const deleteCell = document.createElement('td');
  deleteCell.classList.add('delete');
  deleteCell.innerHTML = '<a href="">X</a>';
  deleteCell.querySelector('a').addEventListener('click', function (e) {
    e.preventDefault();
    e.currentTarget.parentElement.parentElement.remove();
    updateTotal();
  });

  quantity.addEventListener('change', function (e) {
    if(quantity.value <= 0)
      e.currentTarget.parentElement.parentElement.remove();
    else
      priceCell.textContent = parseInt(price, 10) * quantity.value;
    updateTotal();
  });

  row.appendChild(nameCell);
  row.appendChild(quantityCell);
  row.appendChild(priceCell);
  row.appendChild(deleteCell);

  table.appendChild(row);
}

function updateTotal() {
  const rows = document.querySelectorAll('#cart table > tr');
  const values = [...rows].map(r => parseInt(r.querySelector('td:nth-child(3)').textContent, 10));
  const total = values.reduce((t, v) => t + v, 0);
  document.querySelector('#cart table tfoot th:last-child').textContent = total;
}

attachBuyEvents();