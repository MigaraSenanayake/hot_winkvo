   // Fetch item details on Item ID change
    document.getElementById('searchId').addEventListener('input', function() {
        const searchId = this.value;
        if (searchId) {
            fetch(`searchItem.php?id=${searchId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('itemName').value = data.name;
                        document.getElementById('itemPrice').value = data.price;
                        updateAmount();
                    } else {
                        document.getElementById('itemName').value = "Not found";
                        document.getElementById('itemPrice').value = "N/A";
                        document.getElementById('amount').value = "";
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('itemName').value = '';
            document.getElementById('itemPrice').value = '';
            document.getElementById('amount').value = '';
        }
    });

    // Update amount when quantity changes
    document.getElementById('qty').addEventListener('input', updateAmount);

    // Function to calculate and display amount
    function updateAmount() {
        const price = parseFloat(document.getElementById('itemPrice').value) || 0;
        const quantity = parseInt(document.getElementById('qty').value) || 1;
        const amount = price * quantity;
        document.getElementById('amount').value = amount.toFixed(2);
    }