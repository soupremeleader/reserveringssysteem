let addClientBtn = document.getElementById("addClientBtn");
let exitClientBtn = document.getElementById("exitClientBtn");
let addClientSection = document.getElementById("addClientSection");

function addClient() {
    addClientSection.classList.remove("invisible");
}
function exitClient() {
    addClientSection.classList.add("invisible");
}

addClientBtn.addEventListener('click', addClient);
exitClientBtn.addEventListener('click', exitClient);

addClientSection.classList.add("invisible");