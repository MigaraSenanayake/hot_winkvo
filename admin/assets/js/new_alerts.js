document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    const form = e.target;
    const formData = new FormData(form);

    fetch('update_status.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            swal('Success', data.message, 'success').then(() => {
                location.reload(); // Reload the page after success
            });
        } else {
            swal('Error', data.message, 'error');
        }
    })
    .catch(error => {
        swal('Error', 'An unexpected error occurred.', 'error');
        console.error(error);
    });
});

