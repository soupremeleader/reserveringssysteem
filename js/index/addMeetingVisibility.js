let addMeetBtn = document.getElementById("addMeetBtn");
let exitMeetBtn = document.getElementById("exitMeetBtn");

let meetClient = document.getElementById("meetClient");

let tbodyL = document.getElementById("tbodyCal-left");
let tbodyR = document.getElementById("tbodyCal-right");
let tbodySat = document.getElementById("tbodyCal-sat");
let tbodySun = document.getElementById("tbodyCal-sun");

let beginTimeInput = document.getElementById("beginTimeslot");
let endTimeInput = document.getElementById("endTimeslot");

function addMeeting() {
    overlay.classList.remove("invisible");
    overlay.classList.add("flex");
}

function exitMeeting() {
    console.log("hello");
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

    // console.log(e.target.dataset.j)
    switch (e.target.dataset.j) {
        case "3":
            dataset = theadR.childNodes[0].childNodes[0].dataset;
            break;
        case "4":
            dataset = theadR.childNodes[0].childNodes[1].dataset;
            break;
        case "5":
            console.log("hello");
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

addMeetBtn.addEventListener('click', addMeeting);
exitMeetBtn.addEventListener('click', exitMeeting);


tbodyL.addEventListener('click', addTimeMeeting);
tbodyR.addEventListener('click', addTimeMeeting);
tbodySat.addEventListener('click', addTimeMeeting);
tbodySun.addEventListener('click', addTimeMeeting);
