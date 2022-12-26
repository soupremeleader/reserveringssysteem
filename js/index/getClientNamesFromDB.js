let clientNameInput = document.getElementById("meetClient");
let datalist = document.getElementById("dataClients");

clientNameInput.addEventListener('keyup', function () {
    while (datalist.lastChild) {
        datalist.removeChild(datalist.lastChild);
    }

    console.log(clientNameInput.value);
    fetch("ajax-fetch-clients.php",
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json; charset=UTF-8'
            },
            body: JSON.stringify({
                "name": clientNameInput.value
            })
        }).then(res => res.json()).then(data => {
        console.log("data: " + data)
        for (let i = 0; i < data.length; i++) {
            let option = document.createElement("option");
            option.setAttribute("hidden", data[i].client_id);
            option.setAttribute("value", data[i].name);
            option.innerText = data[i].name;
            datalist.appendChild(option);
        }
    });

})