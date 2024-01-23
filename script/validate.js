function validateRegistration() {
    // Email validation
    const emailInput = document.getElementById('email');
    const email = emailInput.value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      displayErrorMessage("Invalid email address");
      highlightError(emailInput);
      return false;
    }

    // Password and confirm password matching
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if (password !== confirmPassword) {
      displayErrorMessage("Passwords do not match");
      highlightError(passwordInput);
      highlightError(confirmPasswordInput);
      return false;
    }

    // Password strength check
    if (password.length < 8) {
      displayErrorMessage("Password should be at least 8 characters long");
      highlightError(passwordInput);
      return false;
    }

    // You can add more sophisticated password strength checks here

    // Phone number validation
    const phoneNumberInput = document.getElementById('phone_number');
    const phoneNumber = phoneNumberInput.value;
    const phoneRegex = /^(\+\d{1,3})?\d{11}$/;
    if (!phoneRegex.test(phoneNumber)) {
      displayErrorMessage("Invalid phone number");
      highlightError(phoneNumberInput);
      return false;
    }

    // Clear any previous error messages
    clearErrorMessage();

    return true;
  }

  function highlightError(inputElement) {
    inputElement.style.border = '2px solid red';

    // Add event listener to reset border on input
    inputElement.addEventListener('input', function resetBorder() {
      inputElement.style.border = ''; // Reset border on input
      inputElement.removeEventListener('input', resetBorder); // Remove the event listener after resetting
    });
  }

  function displayErrorMessage(message) {
    const errorMessageElement = document.getElementById('error-message');
    errorMessageElement.innerHTML = `<h4 style="color: red; font-weight: normal; margin-top: 10px; margin-bottom: -10px;">${message}</h4>`;
  }

  function clearErrorMessage() {
    const errorMessageElement = document.getElementById('error-message');
    errorMessageElement.innerHTML = '';
  }








  