let addMeetBtn = document.getElementById("addMeetBtn");
let exitMeetBtn = document.getElementById("exitMeetBtn");

let meetClient = document.getElementById("meetClient");

let tbodyL = document.getElementById("tbodyCal-left");
let tbodyR = document.getElementById("tbodyCal-right");
let tbodySat = document.getElementById("tbodyCal-sat");
let tbodySun = document.getElementById("tbodyCal-sun");

let beginTimeInput = document.getElementById("beginTimeslot");
let endTimeInput = document.getElementById("endTimeslot");

let editClientSection = document.getElementById("editClientSection");

let meetEditClient = document.getElementById("meetEditClient");
let meetEditDate = document.getElementById("meetEditDate");
let beginTimeslotEdit = document.getElementById("beginTimeslotEdit");
let endTimeslotEdit = document.getElementById("endTimeslotEdit");
let notesEdit = document.getElementById("notesEdit");

let exitEditMeetBtn = document.getElementById("exitEditMeetBtn");

function addMeeting() {
    overlay.classList.remove("invisible");
    overlay.classList.add("flex");
    addMeetSection.classList.remove("invisible");
}

function editMeeting(e) {
    console.log(e.target.parentElement.dataset)
    meetEditClient.placeholder = e.target.parentElement.dataset.name;
    let editDate = new Date(e.target.parentElement.dataset.beginTime);
    meetEditDate.value = editDate.toISOString().substring(0,10);

    beginTimeslotEdit.value = editDate.toISOString().substring(11,16);
    endTimeslotEdit.value = new Date(e.target.parentElement.dataset.endTime).toISOString().substring(11,16);

    // notesEdit.placeholder = e.target.parentElement.dataset.notes;

    overlay.classList.remove("invisible");
    overlay.classList.add("flex");
    editClientSection.classList.remove("invisible");
    addMeetSection.classList.add("invisible");
}

function closeEditMeeting() {
    overlay.classList.add("invisible");
    overlay.classList.remove("flex");
    editClientSection.classList.add("invisible");
}

function exitMeeting() {
    meetClient.value = "";
    overlay.classList.add("invisible");
    overlay.classList.remove("flex");
}

function addTimeMeeting(e) {
    let theadL = document.getElementById("theadCal-left");
    let theadR = document.getElementById("theadCal-right");
    let theadSat = document.getElementById("theadCal-sat");
    let theadSun = document.getElementById("theadCal-sun");
    let dataset;

    if (!e.target.offsetParent.classList.contains("yellow")) {
        switch (e.target.dataset.j) {
            case "3":
                dataset = theadR.childNodes[0].childNodes[0].dataset;
                break;
            case "4":
                dataset = theadR.childNodes[0].childNodes[1].dataset;
                break;
            case "5":
                dataset = theadSat.childNodes[0].childNodes[0].dataset;
                break;
            case "6":
                dataset = theadSun.childNodes[0].childNodes[0].dataset;
                break;
            default:
                dataset = theadL.childNodes[0].childNodes[e.target.dataset.j].dataset;

        }

        // console.log(dataset);
        let meetDate = dataset.year + '-' + dataset.month + '-' + dataset.day;

        beginTimeInput.value = String(e.target.dataset.i).padStart(2, '0') + ':00';
        endTimeInput.value = String(e.target.dataset.i).padStart(2, '0') + ':30';
        document.getElementById("meetDate").value = meetDate;
        addMeeting();
    }
}

function addMeetingEvents(){
    let meetingDivs = document.getElementsByClassName("yellow");

    for (let i = 0; i < meetingDivs.length; i++) {
        // console.log(meetingDivs[i]);
        meetingDivs[i].addEventListener('click', editMeeting);
    }
}

addMeetBtn.addEventListener('click', addMeeting);
exitMeetBtn.addEventListener('click', exitMeeting);
exitEditMeetBtn.addEventListener('click', closeEditMeeting);

addMeetSection.classList.remove("invisible");
editClientSection.classList.add("invisible");
