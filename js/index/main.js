let curOffset = 0;

function getWeek(date) {
    let firstDate = new Date(date.getFullYear(), 0, 1)
    let days = Math.floor((date - firstDate)) / (24 * 60 * 60 * 1000);
    return Math.ceil(days / 7);
}

function calendar(offset) {
    curOffset += parseInt(offset);

    let date = new Date();
    let newDate = new Date(date.getFullYear(), date.getMonth(), (date.getDate() - date.getDay() + curOffset + 1));
    document.getElementById("weeknr").innerText = `Week ${getWeek(newDate)}`;

    document.getElementById("weeknrInput").setAttribute("value", `${getWeek(newDate)}`);
    document.getElementById("yearInput").setAttribute("value", `${newDate.getFullYear()}`);
    document.getElementById("weeknrSubmit").setAttribute("data-weekoffset", `${newDate}`);

    let thead = document.getElementById("theadCal");
    const days = ["Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag", "Zondag"];

    let tr1 = thead.insertRow();
    tr1.insertCell();
    let tr2 = thead.insertRow();
    tr2.insertCell();
    for (let i = 0; i < 7; i++) {
        let td1 = tr1.insertCell();
        td1.appendChild(document.createTextNode(`${days[i]}`));
        let td2 = tr2.insertCell();
        newDate = new Date(date.getFullYear(), date.getMonth(), (date.getDate() - date.getDay() + i + curOffset + 1));
        td2.appendChild(document.createTextNode(`${newDate.getDate()}-${newDate.getMonth() + 1}-${newDate.getFullYear()}`));
    }

    let tbody = document.getElementById("tbodyCal");
    let tr, td;

    for (let i = 0; i < 24; i++) {
        tr = tbody.insertRow();
        td = tr.insertCell();
        td.appendChild(document.createTextNode(`${i}`));
        for (let j = 0; j < 7; j++) {
            tr.insertCell();
        }
    }
}

function offsetWeek(offset) {
    let tbl = document.getElementById("tableCal");
    while (tbl.lastChild) {
        tbl.removeChild(tbl.lastChild);
    }

    let thead = document.createElement("thead");
    thead.setAttribute("id", "theadCal");
    tbl.appendChild(thead);

    let tbody = document.createElement("tbody");
    tbody.setAttribute("id", "tbodyCal");
    tbl.appendChild(tbody);

    let tfoot = document.createElement("tfoot");
    tfoot.setAttribute("id", "tfootCal");
    tbl.appendChild(tfoot);

    calendar(offset);
}

function selectWeeknr() {
    document.getElementById("weeknrForm").classList.remove("invisible");
    document.getElementById("weeknrExit").classList.remove("invisible");
    document.getElementById("weeknrSelect").classList.add("invisible");
}

function exitWeeknrSelect() {
    document.getElementById("weeknrForm").classList.add("invisible");
    document.getElementById("weeknrExit").classList.add("invisible");
    document.getElementById("weeknrSelect").classList.remove("invisible");
}

function submitWeeknr(e) {
    e.preventDefault();
    let weekOffset = (document.getElementById("weeknrInput").value - getWeek(new Date(e.target.dataset.weekoffset))) * 7 + (document.getElementById("yearInput").value - new Date(e.target.dataset.weekoffset).getFullYear()) * 365;
    offsetWeek(weekOffset);
    exitWeeknrSelect();
}

function submitPrevNext(e) {
    offsetWeek(e.target.dataset.offset * 7);
}

function resetOffset() {
    curOffset = 0;
    offsetWeek(0);
}

function addMeeting() {
    document.getElementById("addMeetSection").classList.remove("invisible");
}

function exitMeeting() {
    document.getElementById("addMeetSection").classList.add("invisible");
}

function addClient() {
    document.getElementById("addClientSection").classList.remove("invisible");
}

function exitClient() {
    document.getElementById("addClientSection").classList.add("invisible");
}

let prevBtn = document.getElementById("prevBtnAgenda");
let nextBtn = document.getElementById("nextBtnAgenda");

let weeknrSelect = document.getElementById("weeknrSelect");
let weeknrExit = document.getElementById("weeknrExit");
let weeknrSubmit = document.getElementById("weeknrSubmit");

let todayBtn = document.getElementById("todayBtn");

let addMeetBtn = document.getElementById("addMeetBtn");
let exitMeetBtn = document.getElementById("exitMeetBtn");
let addClientBtn = document.getElementById("addClientBtn");
let exitClientBtn = document.getElementById("exitClientBtn");

let clientNameInput = document.getElementById("meetClient");
let datalist = document.getElementById("dataClients");

prevBtn.addEventListener('click', submitPrevNext);
nextBtn.addEventListener('click', submitPrevNext);

weeknrSelect.addEventListener('click', selectWeeknr);
weeknrExit.addEventListener('click', exitWeeknrSelect);
weeknrSubmit.addEventListener('click', submitWeeknr);

todayBtn.addEventListener('click', resetOffset);

addMeetBtn.addEventListener('click', addMeeting);
exitMeetBtn.addEventListener('click', exitMeeting);
addClientBtn.addEventListener('click', addClient);
exitClientBtn.addEventListener('click', exitClient);

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
            // console.log([i] + ": " + data[i].name);
            datalist.appendChild(option);
        }
    });

})


calendar(0);

document.getElementById("weeknrExit").classList.add("invisible");
document.getElementById("weeknrForm").classList.add("invisible");

document.getElementById("addMeetSection").classList.add("invisible");
document.getElementById("addClientSection").classList.add("invisible");