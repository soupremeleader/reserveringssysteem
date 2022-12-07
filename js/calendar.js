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
        td2.dataset.day = String(newDate.getDate()).padStart(2, '0');
        td2.dataset.month = String(newDate.getMonth() + 1).padStart(2, '0');
        td2.dataset.year = String(newDate.getFullYear());
        td2.appendChild(document.createTextNode(`${newDate.getDate()}-${newDate.getMonth() + 1}-${newDate.getFullYear()}`));
    }

    let tbody = document.getElementById("tbodyCal");
    let tr, td;
    for (let i = 0; i < 24; i++) {

        tr = tbody.insertRow();
        td = tr.insertCell();
        td.appendChild(document.createTextNode(`${i}`));
        for (let j = 0; j < 7; j++) {
            let newTd = document.createElement('td')
            newTd.dataset.i = i;
            newTd.dataset.j = j + 1;
            tr.appendChild(newTd)
        }
    }
    tbody.addEventListener('click', addTimeMeeting);
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

calendar(0);