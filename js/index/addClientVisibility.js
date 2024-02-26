let addClientBtn = document.getElementById("addClientBtn");
let exitClientBtn = document.getElementById("exitClientBtn");
let addClientSection = document.getElementById("addClientSection");
let addMeetSection = document.getElementById("addMeetSection");
let overlay = document.getElementById("overlay");

function addClient(e) {
    console.log("hello");
    // e.stopPropagation();
    addClientSection.classList.remove("invisible");
    if (addMeetSection !== null) {
        addMeetSection.classList.add("invisible");
    } else {
        overlay.classList.remove("invisible");
        overlay.classList.add("flex-center");
    }
}

function exitClient() {
    addClientSection.classList.add("invisible");
    if (addMeetSection !== null) {
        addMeetSection.classList.remove("invisible");
    } else {
        overlay.classList.add("invisible");
        overlay.classList.remove("flex-center");
    }
}

addClientBtn.addEventListener('click', addClient);
exitClientBtn.addEventListener('click', exitClient);

addClientSection.classList.add("invisible");
// addMeetSection.classList.add("invisible");
overlay.classList.add("invisible");