let addMeetBtn = document.getElementById("addMeetBtn");
let exitMeetBtn = document.getElementById("exitMeetBtn");
let addMeetSection = document.getElementById("addMeetSection");

function addMeeting() {
    addMeetSection.classList.remove("invisible");
}

function exitMeeting() {
    addMeetSection.classList.add("invisible");
}

addMeetBtn.addEventListener('click', addMeeting);
exitMeetBtn.addEventListener('click', exitMeeting);

addMeetSection.classList.add("invisible");