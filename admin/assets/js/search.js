
// JavaScript function to filter table rows based on search input
function filterTable() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toUpperCase();
    const table = document.getElementById("menuTable");
    const tr = table.getElementsByTagName("tr");

    // Loop through table rows and hide those that don't match the search
    for (let i = 1; i < tr.length; i++) {
        const categoryCell = tr[i].getElementsByTagName("td")[1];
        const nameCell = tr[i].getElementsByTagName("td")[2];
        if (categoryCell || nameCell) {
            const categoryText = categoryCell.textContent || categoryCell.innerText;
            const nameText = nameCell.textContent || nameCell.innerText;
            if (
                categoryText.toUpperCase().indexOf(filter) > -1 ||
                nameText.toUpperCase().indexOf(filter) > -1
            ) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }       
    }
}
