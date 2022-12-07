let weeknrSelect = document.getElementById("weeknrSelect");
let weeknrExit = document.getElementById("weeknrExit");
let weeknrSubmit = document.getElementById("weeknrSubmit");
let weeknrForm = document.getElementById("weeknrForm");

function selectWeeknr() {
    weeknrForm.classList.remove("invisible");
    weeknrExit.classList.remove("invisible");
    weeknrSelect.classList.add("invisible");

}
function exitWeeknrSelect() {
    weeknrForm.classList.add("invisible");
    weeknrExit.classList.add("invisible");
    weeknrSelect.classList.remove("invisible");

}
function submitWeeknr(e) {
    e.preventDefault();
    let weekOffset = (document.getElementById("weeknrInput").value - getWeek(new Date(e.target.dataset.weekoffset))) * 7 + (document.getElementById("yearInput").value - new Date(e.target.dataset.weekoffset).getFullYear()) * 365;
    offsetWeek(weekOffset);
    exitWeeknrSelect();

}
weeknrSelect.addEventListener('click', selectWeeknr);
weeknrExit.addEventListener('click', exitWeeknrSelect);
weeknrSubmit.addEventListener('click', submitWeeknr);

weeknrExit.classList.add("invisible");
weeknrForm.classList.add("invisible");
