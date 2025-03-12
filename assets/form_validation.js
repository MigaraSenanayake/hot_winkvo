// Function to display a message next to the input field
function showMessage(inputElement, message, type) {
    // Check if there's already a message, and remove it if exists
    if (inputElement.nextSibling && inputElement.nextSibling.classList && inputElement.nextSibling.classList.contains('validation-message')) {
        inputElement.nextSibling.remove();
    }
    
    const messageDiv = document.createElement('div');
    messageDiv.className = `validation-message alert alert-${type}`;
    messageDiv.textContent = message;
    
    // Insert the message right after the input field
    inputElement.insertAdjacentElement('afterend', messageDiv);

    // Automatically remove the message after 4 seconds
    setTimeout(() => {
        if (messageDiv) {
            messageDiv.remove();
        }
    }, 4000);
}

// Set the minimum date for arrival to today
const today = new Date().toISOString().split('T')[0];
const arrivalInput = document.getElementById('arrival-date');
const departureInput = document.getElementById('departure-date');
const dobInput = document.getElementById('dob');
const issueDateInput = document.getElementById('issue-date');
const expDateInput = document.getElementById('exp-date');

// Set minimum and maximum dates
arrivalInput.setAttribute('min', today);
dobInput.setAttribute('max', today);
issueDateInput.setAttribute('max', today);
expDateInput.setAttribute('min', today);
departureInput.setAttribute('min',today);

// Arrival date validation
arrivalInput.addEventListener('input', function () {
    const selectedDate = this.value;
    if (selectedDate < today) {
        showMessage(this, "Arrival date cannot be in the past.", "danger");
        this.value = today; // Reset to today if invalid
    } else {
        departureInput.setAttribute('min', selectedDate); // Set min departure date to arrival date
    }
});

// Departure date validation
departureInput.addEventListener('input', function () {
    const selectedDate = this.value;
    if (selectedDate < arrivalInput.value) {
        showMessage(this, "Departure date cannot be before arrival date.", "danger");
        this.value = arrivalInput.value; // Reset to arrival date if invalid
    }
});

// Date of birth validation
dobInput.addEventListener('input', function () {
    const selectedDate = this.value;
    if (selectedDate > today) {
        showMessage(this, "Date of birth cannot be in the future.", "danger");
        this.value = ''; // Reset if invalid
    }
});

// Issue date validation
issueDateInput.addEventListener('input', function () {
    const selectedDate = this.value;
    if (selectedDate > today) {
        showMessage(this, "Issue date cannot be in the future.", "danger");
        this.value = ''; // Reset if invalid
    }
});

// Expiry date validation
expDateInput.addEventListener('input', function () {
    const selectedDate = this.value;
    if (selectedDate < today) {
        showMessage(this, "Expiry date cannot be in the past.", "danger");
        this.value = ''; // Reset if invalid
    }
});

// Function to validate email format
function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

// Get email input and validation message elements
const emailInput = document.getElementById('email');
const emailMessage = document.getElementById('email-message');

// Real-time email validation
emailInput.addEventListener('input', function () {
    const emailValue = emailInput.value;
    if (emailValue === "") {
        emailMessage.textContent = "Email is required.";
        emailMessage.classList.add('text-danger');
    } else if (!validateEmail(emailValue)) {
        emailMessage.textContent = "Please enter a valid email address.";
        emailMessage.classList.add('text-danger');
    } else {
        emailMessage.textContent = "Email is valid.";
        emailMessage.classList.remove('text-danger');
        emailMessage.classList.add('text-success');
    }
});

// Function to validate password
function validatePassword(password) {
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;
    return passwordPattern.test(password);
}

// Get password and confirm password inputs
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirm-password');
const passwordMessage = document.getElementById('password-message');
const confirmPasswordMessage = document.getElementById('confirm-password-message');

// Real-time password validation
passwordInput.addEventListener('input', function () {
    const passwordValue = passwordInput.value;

    if (validatePassword(passwordValue)) {
        passwordMessage.textContent = "Password is valid.";
        passwordMessage.classList.remove('text-danger');
        passwordMessage.classList.add('text-success');
    } else {
        passwordMessage.textContent = "Password must be at least 6 characters, include one uppercase, one lowercase, one special character, and one number.";
        passwordMessage.classList.remove('text-success');
        passwordMessage.classList.add('text-danger');
    }
});

// Real-time confirm password validation
confirmPasswordInput.addEventListener('input', function () {
    const passwordValue = passwordInput.value;
    const confirmPasswordValue = confirmPasswordInput.value;

    if (confirmPasswordValue === passwordValue) {
        confirmPasswordMessage.textContent = "Passwords match.";
        confirmPasswordMessage.classList.remove('text-danger');
        confirmPasswordMessage.classList.add('text-success');
    } else {
        confirmPasswordMessage.textContent = "Passwords do not match.";
        confirmPasswordMessage.classList.remove('text-success');
        confirmPasswordMessage.classList.add('text-danger');
    }
});

