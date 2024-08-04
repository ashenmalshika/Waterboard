var currentPage = 1;
var rowsPerPage = 15;
var table = document.getElementById("example2");
var totalPages = Math.ceil(table.rows.length / rowsPerPage);
var prevButton = document.getElementById("prevBtn");
var nextButton = document.getElementById("nextBtn");
var pageNumberElement = document.getElementById("pageNumbers");

function showPage(page) {
    var startIndex = (page - 1) * rowsPerPage;
    var endIndex = startIndex + rowsPerPage;
    var rows = table.rows;

    for (var i = 1; i < rows.length; i++) {
        if (i >= startIndex && i < endIndex) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }

    pageNumberElement.textContent = "Page " + page + " of " + totalPages;
    updateButtons(page);
}

function updateButtons(page) {
    if (page === 1) {
        prevButton.disabled = true;
    } else {
        prevButton.disabled = false;
    }

    if (page === totalPages) {
        nextButton.disabled = true;
    } else {
        nextButton.disabled = false;
    }
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
    }
}

function nextPage() {
    if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
    }
}

prevButton.addEventListener("click", prevPage);
nextButton.addEventListener("click", nextPage);

showPage(currentPage);