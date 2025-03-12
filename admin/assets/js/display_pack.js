   // Fetch item details on Item ID change
   document.getElementById('packageId').addEventListener('input', function() {
    const packageId = this.value;
    if (packageId) {
        fetch(`search_packs.php?id=${packageId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('package_name').value = data.package_name;
                    document.getElementById('price').value = data.price;
                    document.getElementById('s_charge').value = data.s_charge;
                    
                } else {
                    document.getElementById('package_name').value = "Not found";
                    document.getElementById('price').value = "N/A";
                    document.getElementById('s_charge').value = "N/A";
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('package_name').value = '';
        document.getElementById('price').value = '';
        document.getElementById('s_charge').value = '';
    }
});

