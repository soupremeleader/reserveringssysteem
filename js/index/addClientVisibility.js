let addClientBtn = document.getElementById("addClientBtn");
let exitClientBtn = document.getElementById("exitClientBtn");
let addClientSection = document.getElementById("addClientSection");
let addMeetSection = document.getElementById("addMeetSection");

function addClient() {
    addClientSection.classList.remove("invisible");
    addMeetSection.classList.add("invisible");
}
function exitClient() {
    addClientSection.classList.add("invisible");
    addMeetSection.classList.remove("invisible");
}

addClientBtn.addEventListener('click', addClient);
exitClientBtn.addEventListener('click', exitClient);

addClientSection.classList.add("invisible");
// addMeetSection.classList.add("invisible");