<?php ?>
<!doctype html>
<html lang="en">

<style>
    table, tr, td {
        border: 1px solid black;
    }

    .invisible {
        display:none;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header>
    <button id="todayBtn">Vandaag</button>
    <div style="display:flex">
        <button id="prevBtn" data-offset="-1"> <-</button>
        <div>
            <div style="display:flex">
                <p id="weeknr"></p>
                <button id="weeknrSelect">V</button>
                <button id="weeknrExit">X</button>
            </div>
            <form id="weeknrForm">
                <label for="weeknrInput">Week</label>
                <input type="number" id="weeknrInput"/>
                <label for="yearInput"></label>
                <input type="number" id="yearInput"/>
                <button id="weeknrSubmit">OK</button>
            </form>
        </div>
        <button id="nextBtn" data-offset="1"> -></button>
    </div>
</header>
<main>
    <table id="tableCal">
        <thead id="theadCal"></thead>
        <tbody id="tbodyCal"></tbody>
        <tfoot id="theadCal"></tfoot>
    </table>

</main>
</body>
</html>
<script>
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
        let weekOffset = (document.getElementById("weeknrInput").value - getWeek(new Date(e.target.dataset.weekoffset))) * 7 + (document.getElementById("yearInput").value - new Date(e.target.dataset.weekoffset).getFullYear()) * 365 ;
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

    let prevBtn = document.getElementById("prevBtn");
    let nextBtn = document.getElementById("nextBtn");

    let weeknrSelect = document.getElementById("weeknrSelect");
    let weeknrExit = document.getElementById("weeknrExit");
    let weeknrSubmit = document.getElementById("weeknrSubmit");

    let todayBtn = document.getElementById("todayBtn");

    prevBtn.addEventListener('click', submitPrevNext);
    nextBtn.addEventListener('click', submitPrevNext);

    weeknrSelect.addEventListener('click', selectWeeknr);
    weeknrExit.addEventListener('click', exitWeeknrSelect);
    weeknrSubmit.addEventListener('click', submitWeeknr);

    todayBtn.addEventListener('click', resetOffset);

    calendar(0);

    document.getElementById("weeknrExit").classList.add("invisible");
    document.getElementById("weeknrForm").classList.add("invisible");
</script>
