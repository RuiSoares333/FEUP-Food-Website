function attachBuyEvents() {
    const buttons = document.querySelectorAll('#dishes article')
    for (const button of buttons)
        button.addEventListener('click', function() {

          const dataId = this.getAttribute('data-id')
          const row = document.createElement('tr');

          let tRows = document.querySelectorAll('#ads table > tr');
          let replaced = false;

          const footer = document.querySelector('#ads tfoot');


          let element = document.createElement('td');
          element.textContent = this.querySelector('p:nth-child(2)').textContent;
          row.appendChild(element);

          document.createElement(input)
          input.setAtribute("type", "number")
          input.value = 1
          element.appendChild(input);

          element = document.createElement('td');
          element.value = input;
          row.appendChild(element);

          
          const price = this.querySelector('p:nth-child(3)');
  
          element = document.createElement('td');
          element.textContent = (parseInt(input) * parseInt(price));
          row.appendChild(element);

          element = document.createElement('td');
          const rm =  document.createElement('button');
          rm.textContent = 'X';
          element.appendChild(rm);
          row.appendChild(element)

          element = document.createElement('td');
          element.textContent = dataId;
          element.style.display = 'none';
          row.appendChild(element);


        
          for(const tRow of tRows){
            if(parseInt(tRow.querySelector('td:nth-child(5)').textContent) === parseInt(dataId)){
                document.querySelector('#ads table').replaceChild(row, tRow);
                replaced = true;
                break;
            }
          }

          if(!replaced){
            document.querySelector('#ads table').insertBefore(row, footer);
          }

          let total = 0;
          tRows = document.querySelectorAll('#ads table > tr');

          for(const tRow of tRows){
            total += parseInt(tRow.querySelector('td:nth-child(3)').textContent);
          }

          footer.querySelector('th:last-child').textContent = total;

          rm.addEventListener('click', function(){
              this.parentElement.parentElement.remove();
              total = 0;
              tRows = document.querySelectorAll('#ads table > tr');
              for(const tRow of tRows){
                  total += tRow.querySelector('td:nth-child(3)').textContent;
              }
              footer.querySelector('th:last-child').textContent = total;
          })
        


    })
}

  
attachBuyEvents()