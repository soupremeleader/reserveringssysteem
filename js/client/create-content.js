let filterInput = document.getElementById("filterInput");
let leftContent = document.getElementById("left-content");
let rightContent = document.getElementById("right-content");
let header = document.getElementById("contactHeader");

function createNameDiv(contactDiv, client, odd) {
    let nameDiv = document.createElement("div");
    nameDiv.classList.add("infoDiv");

    let iconDiv = document.createElement("div");
    iconDiv.classList.add("iconsDiv");
    if (!odd) {
        iconDiv.classList.add("even");
    }

    let infoIconDiv = document.createElement("div");
    let editIconDiv = document.createElement("div");
    let deleteIconDiv = document.createElement("div");

    infoIconDiv.classList.add("iconDiv");
    editIconDiv.classList.add("iconDiv");
    deleteIconDiv.classList.add("iconDiv");

    let name = document.createElement("p");
    name.innerText = client.name;
    name.classList.add("goldText");
    if (odd) {
        name.classList.add("odd");
    }

    let infoLink = document.createElement("a");
    infoLink.href = `details.php?id=${client.client_id}`;
    infoIconDiv.appendChild(infoLink);

    let infoIcon = document.createElement("img");
    infoIcon.src = "stylesheets/icon/circle-info-solid.svg";
    infoIcon.classList.add("crudIcons");
    infoLink.appendChild(infoIcon);

    let editIcon = document.createElement("img");
    editIcon.src = "stylesheets/icon/pen-to-square-solid.svg";
    editIcon.classList.add("crudIcons");
    editIconDiv.appendChild(editIcon);

    let deleteIcon = document.createElement("img");
    deleteIcon.src = "stylesheets/icon/trash-can-regular.svg";
    deleteIcon.classList.add("crudIcons");
    deleteIconDiv.appendChild(deleteIcon);

    if (odd) {
        nameDiv.appendChild(iconDiv);
        nameDiv.appendChild(name);
    } else {
        nameDiv.appendChild(name);
        nameDiv.appendChild(iconDiv);
    }

    iconDiv.appendChild(infoIconDiv);
    iconDiv.appendChild(editIconDiv);
    iconDiv.appendChild(deleteIconDiv);

    contactDiv.appendChild(nameDiv);
}

function createContactDiv(contactDiv, client, odd) {
    let emailDiv = document.createElement("div");
    emailDiv.classList.add("contactInfo");
    let phoneDiv = document.createElement("div");
    phoneDiv.classList.add("contactInfo");

    let emailIconDiv = document.createElement("div");
    emailIconDiv.classList.add("contactIconDiv");
    let phoneIconDiv = document.createElement("div");
    phoneIconDiv.classList.add("contactIconDiv");

    let email = document.createElement("p");
    email.classList.add("limeGreenText");
    let phone = document.createElement("p");
    phone.classList.add("limeGreenText");

    let emailIcon = document.createElement("img");
    emailIcon.src = "stylesheets/icon/envelope-solid.svg";
    emailIcon.classList.add("contactIcons");
    emailIconDiv.appendChild(emailIcon);

    let phoneIcon = document.createElement("img");
    phoneIcon.src = "stylesheets/icon/phone-solid.svg";
    phoneIcon.classList.add("contactIcons");
    phoneIconDiv.appendChild(phoneIcon);

    email.innerText = client.email;
    phone.innerText = client.phonenumber;

    if (odd) {
        email.classList.add("odd");
        phone.classList.add("odd");

        emailDiv.appendChild(email);
        phoneDiv.appendChild(phone);

        emailDiv.appendChild(emailIconDiv);
        phoneDiv.appendChild(phoneIconDiv);
    } else {
        emailDiv.appendChild(emailIconDiv);
        phoneDiv.appendChild(phoneIconDiv);

        emailDiv.appendChild(email);
        phoneDiv.appendChild(phone);
    }

    contactDiv.appendChild(emailDiv);
    contactDiv.appendChild(phoneDiv);

}

function createContent() {
    while(leftContent.lastChild) {
        leftContent.removeChild(leftContent.lastChild);
    }

    while(rightContent.lastChild) {
        rightContent.removeChild(rightContent.lastChild);
    }

    fetch("ajax-fetch-clients-all.php",
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json; charset=UTF-8'
            },
            body: JSON.stringify({
                "name": filterInput.value
            })
        }).then(res => res.json()).then(data => {
            header.dataset.total = data.length;

            let leftLength = 4;
            let rightLength = 5;
            let length = data.length <= leftLength + rightLength ? data.length : leftLength + rightLength;

            if (header.dataset.pageNr === "0") {
                prevBtnClient.classList.add("invisible");
            } else {
                prevBtnClient.classList.remove("invisible");
            }

            if (data.length <= header.dataset.pageNr + 1 * (leftLength + rightLength)) {
                nextBtnClient.classList.add("invisible");
            } else {
                nextBtnClient.classList.remove("invisible");
            }

            let contactDiv;

            let start = header.dataset.pageNr * (leftLength + rightLength);

            for (let i = start; i < start + length; i++) {
                contactDiv = document.createElement("div");
                if ((i - start) % 2 === 1) {
                    contactDiv.classList.add("oddContact");
                    createNameDiv(contactDiv, data[i], 1);
                    createContactDiv(contactDiv, data[i], 1);
                } else {
                    createNameDiv(contactDiv, data[i], 0);
                    createContactDiv(contactDiv, data[i], 0);
                }

                if (i < leftLength + start) {
                    leftContent.appendChild(contactDiv);
                    contactDiv.classList.add("contactDivLeft");
                } else {
                    rightContent.append(contactDiv);
                    contactDiv.classList.add("contactDivRight");
                }
            }
        }
    )
}

filterInput.addEventListener('keyup', function () {
    createContent();
});

header.dataset.pageNr = 0;
createContent();