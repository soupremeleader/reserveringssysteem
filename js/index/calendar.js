let curOffset = 0;

function getMeeting(offset) {
    let date = new Date();
    let beginDate = new Date(date.getFullYear(), date.getMonth(), (date.getDate() - date.getDay() + curOffset + 1));
    let endDate = new Date(date.getFullYear(), date.getMonth(), (date.getDate() - date.getDay() + curOffset + 8));

    fetch("ajax-fetch-meetings.php",
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json; charset=UTF-8'
            },
            body: JSON.stringify({
                "beginDay": beginDate.getDate(),
                "beginMonth": beginDate.getMonth() + 1,
                "beginYear": beginDate.getFullYear(),

                "endDay": endDate.getDate(),
                "endMonth": endDate.getMonth() + 1,
                "endYear": endDate.getFullYear()
            })
        }).then(res => res.json()).then(meetings => {
        createCalendar(offset, meetings)
        addMeetingEvents();
    })
}

function addMeetingDiv(clientId, meetingId, timeslotId, name, thisHour, beginHour, beginMin, endHour, endMin) {
    let thisMin = 0;
    let div = document.createElement("div");
    div.dataset.client = clientId;
    div.dataset.meeting = meetingId;
    div.dataset.timeslot = timeslotId;
    div.classList.add("yellow");
    let height;

    // check if the meeting starts before this hour
    if (beginHour !== thisHour) {

        // check if the meeting ends after this hour
        if (endHour !== thisHour) {
            height = 100;

            // meeting ends before this hour
        } else {
            height = endMin * 100 / 60;
            thisMin = endMin;
        }
    } else {
        // check if there is not a break before the next meeting
        if (thisMin === beginMin) {

            // check if the meeting ends after this hour
            if (endHour !== thisHour) {
                height = (60 - beginMin) * 100 / 60;
            } else {
                height = (endMin - beginMin) * 100 / 60;
                thisMin = endMin;
            }
        } else {
            let div2 = document.createElement("div");
            div2.style.height = `${(beginMin - thisMin) * 100 / 60}%`;

            if (endHour !== thisHour) {
                height = (60 - beginMin) * 100 / 60;
            } else {
                height = (endMin - beginMin) * 100 / 60;
                thisMin = endMin;
            }
        }
    }

    div.style.height = `${height}%`;
}

function getWeek(date) {
    let firstDate = new Date(date.getFullYear(), 0, 1)
    let days = Math.floor((date - firstDate)) / (24 * 60 * 60 * 1000);
    return Math.ceil(days / 7);
}

function createCalendar(offset, meetings) {
    console.log(meetings);
    curOffset += parseInt(offset);

    const months = ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December"];

    let date = new Date();
    let newDate = new Date(date.getFullYear(), date.getMonth(), (date.getDate() - date.getDay() + curOffset + 1));
    document.getElementById("weeknr").innerText = `${months[newDate.getMonth()]} ${newDate.getFullYear()} - Week ${getWeek(newDate)}`;

    document.getElementById("weeknrInput").setAttribute("value", `${getWeek(newDate)}`);
    document.getElementById("yearInput").setAttribute("value", `${newDate.getFullYear()}`);
    document.getElementById("weeknrSubmit").setAttribute("data-weekoffset", `${newDate}`);

    let theadL = document.getElementById("theadCal-left");
    let theadR = document.getElementById("theadCal-right");
    let theadSat = document.getElementById("theadCal-sat");
    let theadSun = document.getElementById("theadCal-sun");
    const days = ["Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag", "Zondag"];

    let tr, td;

    let trL = theadL.insertRow();
    let trR = theadR.insertRow();
    let trSat = theadSat.insertRow();
    let trSun = theadSun.insertRow();

    trL.insertCell();
    trR.insertCell();

    for (let i = 0; i < 7; i++) {
        if (i < 3) {
            td = trL.insertCell();
        } else if (i < 5) {
            td = trR.insertCell();
        } else if (i === 5) {
            td = trSat.insertCell();
        } else {
            td = trSun.insertCell();
        }

        newDate = new Date(date.getFullYear(), date.getMonth(), (date.getDate() - date.getDay() + i + curOffset + 1));
        td.dataset.day = String(newDate.getDate()).padStart(2, '0');
        td.dataset.month = String(newDate.getMonth() + 1).padStart(2, '0');
        td.dataset.year = String(newDate.getFullYear());

        let daytxt = document.createElement('p');
        daytxt.innerHTML = days[i];
        daytxt.classList.add("goldTxt");
        daytxt.classList.add("dateTxt");

        let datetxt = document.createElement('p');
        datetxt.innerText = ` ${newDate.getDate()}`;
        datetxt.classList.add("limeTxt");
        datetxt.classList.add("dateTxt");

        td.appendChild(daytxt);
        td.appendChild(datetxt);
    }

    let tdL, tdR;
    let tbodyL = document.getElementById("tbodyCal-left");
    let tbodyR = document.getElementById("tbodyCal-right");
    let tbodySat = document.getElementById("tbodyCal-sat");
    let tbodySun = document.getElementById("tbodyCal-sun");

    for (let i = 8; i < 22; i++) {

        trL = tbodyL.insertRow();
        trR = tbodyR.insertRow();
        trSat = tbodySat.insertRow();
        trSun = tbodySun.insertRow();

        tdL = trL.insertCell();
        tdR = trR.insertCell();
        tdL.classList.add("buttonGreenTxt");
        tdR.classList.add("buttonGreenTxt");


        tdL.appendChild(document.createTextNode(`${i}:00`));
        tdR.appendChild(document.createTextNode(`${i}:00`));

        for (let j = 0; j < 7; j++) {
            let newTd = document.createElement('td');

            if (i % 2 === 0) {
                newTd.classList.add("evenHours");
            } else {
                newTd.classList.add("oddHours");
            }

            if (j < 3) {
                newTd.dataset.i = i;
                newTd.dataset.j = j + 1;
                trL.appendChild(newTd);
            } else if (j < 5) {
                newTd.dataset.i = i;
                newTd.dataset.j = j + 1;
                trR.appendChild(newTd);
            } else if (j === 5 && i < 13) {
                newTd.dataset.i = i;
                newTd.dataset.j = j + 1;
                trSat.appendChild(newTd);
            } else if (j === 6 && i < 13) {
                newTd.dataset.i = i;
                newTd.dataset.j = j + 1;
                trSun.appendChild(newTd);
            }


            for (let k = 0; k < meetings.length; k++) {
                if (new Date(meetings[k].begin_time).getDay() === j + 1 && new Date(meetings[k].begin_time).getHours() === i) {
                    let timeDiv = document.createElement("div");
                    let nameDiv = document.createElement("div");

                    newTd.appendChild(timeDiv);
                    newTd.appendChild(nameDiv);

                    newTd.classList.add("yellow");
                    newTd.classList.remove("evenHours");
                    newTd.classList.remove("oddHours");
                    timeDiv.classList.add("timeColour");

                    timeDiv.innerText = `${new Date(meetings[k].begin_time).getHours()}:${new Date(meetings[k].begin_time).getMinutes()<10?'0':''}${new Date(meetings[k].begin_time).getMinutes()}-${new Date(meetings[k].end_time).getHours()}:${new Date(meetings[k].end_time).getMinutes()}`
                    nameDiv.innerText = meetings[k].name;

                    newTd.dataset.name = meetings[k].name;
                    newTd.dataset.beginTime = meetings[k].begin_time;
                    newTd.dataset.endTime = meetings[k].end_time;
                    newTd.dataset.notes = meetings[k].extra_notes;
                    k++;
                } else if (new Date(meetings[k].begin_time).getDay() === 0 && j === 6 && new Date(meetings[k].begin_time).getHours() === i) {
                    let timeDiv = document.createElement("div");
                    let nameDiv = document.createElement("div");

                    newTd.appendChild(timeDiv);
                    newTd.appendChild(nameDiv);

                    newTd.classList.add("yellow");
                    newTd.classList.remove("evenHours");
                    newTd.classList.remove("oddHours");
                    timeDiv.classList.add("timeColour");

                    timeDiv.innerText = `${new Date(meetings[k].begin_time).getHours()}:${new Date(meetings[k].begin_time).getMinutes()<10?'0':''}${new Date(meetings[k].begin_time).getMinutes()}-${new Date(meetings[k].end_time).getHours()}:${new Date(meetings[k].end_time).getMinutes()}`
                    nameDiv.innerText = meetings[k].name;

                    newTd.dataset.name = meetings[k].name;
                    newTd.dataset.beginTime = meetings[k].begin_time;
                    newTd.dataset.endTime = meetings[k].end_time;
                    newTd.dataset.notes = meetings[k].extra_notes;

                    k++;
                }
            }
        }
    }

    tbodyL.addEventListener('click', addTimeMeeting);
    tbodyR.addEventListener('click', addTimeMeeting);
    tbodySat.addEventListener('click', addTimeMeeting);
    tbodySun.addEventListener('click', addTimeMeeting);
}

function offsetWeek(offset) {
    deleteTables();
    createTables();
    getMeeting(offset);
}

getMeeting(0);