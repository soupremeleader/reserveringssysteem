let prevBtnClient = document.getElementById("prevBtnClient");
let nextBtnClient = document.getElementById("nextBtnClient");

function prevNextClient(e) {
    console.log('hello')
    console.log(e.target);
    header.dataset.pageNr = parseInt(header.dataset.pageNr,10) + parseInt(e.target.dataset.offset, 10);
    createContent();
}

prevBtnClient.addEventListener('click', prevNextClient);
nextBtnClient.addEventListener('click', prevNextClient);