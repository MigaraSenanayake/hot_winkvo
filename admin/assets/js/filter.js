function filterTable() {
    // Get input value and convert to lowercase
    const searchInput = document.getElementById("searchRInput").value.toLowerCase();
    
    // Get table rows
    const table = document.getElementById("roomTable");
    const rows = table.getElementsByTagName("tr");
    
    // Loop through all rows and hide those that don't match the search query
    for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the table header
        const cols = rows[i].getElementsByTagName("td");
        const id = cols[0]?.textContent.toLowerCase() || "";
        const category = cols[1]?.textContent.toLowerCase() || "";
        const roomtype = cols[2]?.textContent.toLowerCase() || "";
        const meal = cols[3]?.textContent.toLowerCase() || "";

        // Check if any column matches the search input
        if (
            id.includes(searchInput) || 
            category.includes(searchInput) || 
            roomtype.includes(searchInput) || 
            meal.includes(searchInput)
        ) {
            rows[i].style.display = ""; // Show row
        } else {
            rows[i].style.display = "none"; // Hide row
        }
    }
}


function filterbyNIC() {
    // Get input value and convert to lowercase
    const searchInput = document.getElementById("searchNIC").value.toLowerCase();    
    // Get table rows
    const table = document.getElementById("bcusTable");
    const rows = table.getElementsByTagName("tr");
    
    // Loop through all rows and hide those that don't match the search query
    for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the table header
        const cols = rows[i].getElementsByTagName("td");
        const nic_pp = cols[5]?.textContent.toLowerCase();
        

        // Check if any column matches the search input
        if (nic_pp.includes(searchInput)) {
            rows[i].style.display = ""; // Show row
        } else {
            rows[i].style.display = "none"; // Hide row
        }
    }
}



function filterbymonthYear() {
    const searchInput = document.getElementById("searchmonthYear").value.toLowerCase();
    const table = document.getElementById("paymentTb");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length - 1; i++) { // Skip header and footer
        const cols = rows[i].getElementsByTagName("td");
        const paymentDate = cols[7]?.textContent.toLowerCase();
        if (paymentDate.includes(searchInput)) {
            rows[i].style.display = ""; // Show row
        } else {
            rows[i].style.display = "none"; // Hide row
        }
    }

    // Recalculate totals for visible rows
    calculateTotals();
}


// Helper function to validate and format 'YYYY-MM' input
function parseSearchDate(input) {
    const match = input.match(/^(\d{4})-(\d{1,2})$/); // Matches 'YYYY-MM'
    if (match) {
        const [_, year, month] = match;
        return `${year}-${String(month).padStart(2, '0')}`; // Ensure 'YYYY-MM' format
    }
    return null;
}

// Helper function to extract 'YYYY-MM' from 'YYYY-MM-DD HH:MM:SS'
function extractYearMonth(dateTime) {
    const match = dateTime.match(/^(\d{4})-(\d{2})/); // Matches 'YYYY-MM' at the start
    return match ? match[0] : null; // Return 'YYYY-MM' or null if invalid
}
