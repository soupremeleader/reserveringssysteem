let tblL = document.getElementById("tableCal-left");
let tblR = document.getElementById("tableCal-right");
let tblSat = document.getElementById("tableCal-sat");
let tblSun = document.getElementById("tableCal-sun");

function createLeft() {
    let theadL = document.createElement("thead");
    theadL.setAttribute("id", "theadCal-left");
    tblL.appendChild(theadL);

    let tbodyL = document.createElement("tbody");
    tbodyL.setAttribute("id", "tbodyCal-left");
    tblL.appendChild(tbodyL);

    let tfootL = document.createElement("tfoot");
    tfootL.setAttribute("id", "tfootCal-left");
    tblL.appendChild(tfootL);
}

function createRight() {
    let theadR = document.createElement("thead");
    theadR.setAttribute("id", "theadCal-right");
    tblR.appendChild(theadR);

    let tbodyR = document.createElement("tbody");
    tbodyR.setAttribute("id", "tbodyCal-right");
    tblR.appendChild(tbodyR);

    let tfootR = document.createElement("tfoot");
    tfootR.setAttribute("id", "tfootCal-right");
    tblR.appendChild(tfootR);
}

function createSat() {
    let theadSat = document.createElement("thead");
    theadSat.setAttribute("id", "theadCal-sat");
    tblSat.appendChild(theadSat);

    let tbodySat = document.createElement("tbody");
    tbodySat.setAttribute("id", "tbodyCal-sat");
    tblSat.appendChild(tbodySat);

    let tfootSat = document.createElement("tfoot");
    tfootSat.setAttribute("id", "tfootCal-sat");
    tblSat.appendChild(tfootSat);
}

function createSun() {
    let theadSun = document.createElement("thead");
    theadSun.setAttribute("id", "theadCal-sun");
    tblSun.appendChild(theadSun);

    let tbodySun = document.createElement("tbody");
    tbodySun.setAttribute("id", "tbodyCal-sun");
    tblSun.appendChild(tbodySun);

    let tfootSun = document.createElement("tfoot");
    tfootSun.setAttribute("id", "tfootCal-sun");
    tblSun.appendChild(tfootSun);
}


function createTables() {
    createLeft();
    createRight();
    createSat();
    createSun();
}

function deleteTables() {

    while (tblL.lastChild) {
        tblL.removeChild(tblL.lastChild);
    }

    while (tblR.lastChild) {
        tblR.removeChild(tblR.lastChild);
    }

    while (tblSat.lastChild) {
        tblSat.removeChild(tblSat.lastChild);
    }

    while (tblSun.lastChild) {
        tblSun.removeChild(tblSun.lastChild);
    }
}