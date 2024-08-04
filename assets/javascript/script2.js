function searchTable() {
    var input = document.getElementById("searchInput").value.toLowerCase();
    var table = document.getElementById("example2");
    var tbody = table.getElementsByTagName("tbody")[0];
    var rows = tbody.getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var match = false;
        for (var j = 0; j < cells.length; j++) {
            if (cells[j].textContent.toLowerCase().indexOf(input) > -1) {
                match = true;
                break;
            }
        }
        if (match) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}
