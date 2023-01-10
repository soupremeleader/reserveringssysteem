let prevBtn = document.getElementById("prevBtn");
let nextBtn = document.getElementById("nextBtn");
let todayBtn = document.getElementById("todayBtn");


function submitPrevNext(e) {
    tbodyL.removeEventListener('click', addTimeMeeting);
    tbodyR.removeEventListener('click', addTimeMeeting);
    tbodySat.removeEventListener('click', addTimeMeeting);
    tbodySun.removeEventListener('click', addTimeMeeting);
    offsetWeek(e.target.dataset.offset * 7);
}

function resetOffset() {
    curOffset = 0;

    tbodyL.removeEventListener('click', addTimeMeeting);
    tbodyR.removeEventListener('click', addTimeMeeting);
    tbodySat.removeEventListener('click', addTimeMeeting);
    tbodySun.removeEventListener('click', addTimeMeeting);

    offsetWeek(0);
}

prevBtn.addEventListener('click', submitPrevNext);
nextBtn.addEventListener('click', submitPrevNext);
todayBtn.addEventListener('click', resetOffset);