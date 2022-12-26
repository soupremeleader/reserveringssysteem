let addMeetBtn = document.getElementById("addMeetBtn");
let exitMeetBtn = document.getElementById("exitMeetBtn");
let addMeetSection = document.getElementById("addMeetSection");

let meetClient = document.getElementById("meetClient");

let tbody = document.getElementById("tbodyCal");

let beginTimeInput = document.getElementById("beginTimeslot");
let endTimeInput = document.getElementById("endTimeslot");

function addMeeting() {
    addMeetSection.classList.remove("invisible");
}

function exitMeeting() {
    meetClient.value = "";
    addMeetSection.classList.add("invisible");
}

function addTimeMeeting(e) {
    let thead = document.getElementById("theadCal");

    let dataset = thead.childNodes[1].childNodes[e.target.dataset.j].dataset;
    let meetDate = dataset.year + '-' + dataset.month + '-' + dataset.day;

    beginTimeInput.value = String(e.target.dataset.i).padStart(2, '0') + ':00';
    endTimeInput.value = String(e.target.dataset.i).padStart(2, '0') + ':30';
    document.getElementById("meetDate").value = meetDate;
    addMeeting();
}

addMeetBtn.addEventListener('click', addMeeting);
exitMeetBtn.addEventListener('click', exitMeeting);

addMeetSection.classList.add("invisible");


// tbody.addEventListener('click', addTimeMeeting);