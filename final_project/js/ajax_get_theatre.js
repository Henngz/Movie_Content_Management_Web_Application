const searchBar = document.getElementById('searchBar');
const btn = document.getElementById('btn');
const tableBody = document.getElementById('table-body');
const table = document.getElementById('table');
const error = document.getElementById('error');


btn.addEventListener('click',uploadData);

function uploadData(){

    let name = searchBar.value;
    console.log(searchBar.value);
    const apiUrl = 'https://data.cityofnewyork.us/resource/2hzz-95k8.json?' +
                    `$where=lower(name) LIKE lower('%${name}%')` +
                    '&$order=zip' +
                    '&$limit=100';
    const encodedURL = encodeURI(apiUrl);

   fetch(encodedURL)
     .then(function (result) {
       return result.json(); 
     })
     .then(function (data) {
        

        var length = data.length;
        console.log(length);
        let dataHtml = '';

        if(length >= 100){
          // Make current error invisible
          if (error.style.display === "block") {
            error.style.display = "none";
          }

          table.style.display="block";

            for(let i = 0; i<100; i++){
                dataHtml += `<tr>
                            <td>${data[i].name}</td>
                            <td>${data[i].address1}</td>
                            <td>${data[i].tel}</td>
                            <td>${data[i].zip}</td>
                           </tr>`;
            }
            tableBody.innerHTML = dataHtml;         
        }
        else if(length>0 && length<100){   
          // Make current error invisible
          if (error.style.display === "block") {
            error.style.display = "none";
          }

          table.style.display="block";

           for(let oneData of data){
                dataHtml += `<tr>
                            <td>${oneData.name}</td>
                            <td>${oneData.address1}</td>
                            <td>${oneData.tel}</td>
                            <td>${oneData.zip}</td>
                            </tr>`;
           }
           tableBody.innerHTML = dataHtml;          
        }
        else if(length<1){        
          if (table.style.display === "block") {
            table.style.display = "none";
          } 
            error.style.display = "block";        
        }
     })
}
