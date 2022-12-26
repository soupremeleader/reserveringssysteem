let tbody = document.getElementById("tbodyClient");
let deleteClientSection = document.getElementById("deleteClientSection");
let exitDelete = document.getElementById("deleteClientBtn");
let deleteQuestion = document.getElementById("deleteQuestion");
let yesAnswer = document.getElementById("yesBtn");
let noAnswer = document.getElementById("noBtn");

function edit(e) {
    console.log(e);
    if ("edit" in e.target.dataset) {
        addClient();
        document.getElementById("clientName").value = e.target.dataset.name;
        document.getElementById("clientPhone").value = e.target.dataset.phone;
        document.getElementById("clientEmail").value = e.target.dataset.email;

    } else if ("remove" in e.target.dataset) {
        deleteQuestion.innerText = `Wil je ${e.target.dataset.name} verwijderen?`;
        deleteClientSection.classList.remove("invisible");
        yesAnswer.dataset.id = e.target.dataset.remove;
    }
}

function deleteClient(e) {
    fetch("ajax-delete-client.php",
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json; charset=UTF-8'
            },
            body: JSON.stringify({
                "client_id": e.target.dataset.id
            })
        }).then(res => res.json()).then(data => {
        while (tbody.lastChild) {
            tbody.removeChild(tbody.lastChild);
        }
        exitDeleteClient();
        let tr;
        let td;
        let a;
        let img;
        for (let i = 0; i < data.length; i++) {
            tr = tbody.insertRow();

            td = tr.insertCell();
            td.appendChild(document.createTextNode(data[i].name));
            td.classList.add("is-vcentered");

            td = tr.insertCell();
            td.appendChild(document.createTextNode(data[i].email));
            td.classList.add("is-vcentered");

            td = tr.insertCell();
            td.appendChild(document.createTextNode(data[i].phonenumber));
            td.classList.add("is-vcentered");

            td = tr.insertCell();
            a = document.createElement('a');
            a.href = `details.php?id=${data[i].client_id}`;
            img = document.createElement('img');
            img.src ="img/circle-info-solid.svg";
            img.classList.add("icon");

            a.appendChild(img);
            td.appendChild(a);
            td.classList.add("is-vcentered");

            td = tr.insertCell();
            img = document.createElement('img');
            img.src = "img/pen-to-square-solid.svg";
            img.classList.add("icon");

            img.dataset.edit = data[i].client_id;
            img.dataset.name = data[i].name;
            img.dataset.email = data[i].email;
            img.dataset.phone = data[i].phonenumber;

            td.appendChild(img);

            td = tr.insertCell();
            img = document.createElement('img');
            img.src = "img/trash-can-regular.svg";
            img.classList.add("icon");

            img.dataset.remove = data[i].client_id;
            img.dataset.name = data[i].name;

            td.appendChild(img);
        }
        // console.l-og(data);
    });
}

function exitDeleteClient() {
    deleteQuestion.innerText = "";
    deleteClientSection.classList.add("invisible");
}

yesAnswer.addEventListener('click', deleteClient);

exitDelete.addEventListener('click', exitDeleteClient);
noAnswer.addEventListener('click', exitDeleteClient);

tbody.addEventListener('click', edit);

deleteClientSection.classList.add("invisible");
