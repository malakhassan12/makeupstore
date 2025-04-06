function validateForm(event) {
    event.preventDefault(); // Prevent form from refreshing the page

    let form = event.target;
    
    let emailin = document.querySelector('input[name="Email"]');
    let passwordin = document.querySelector('input[name="password"]');
    
    let emailError = emailin?.closest('.row')?.querySelector('.wrongE');
    let passwordError = passwordin?.closest('.row')?.querySelector('.wrongP');

    let result = document.querySelector(".res");

    // Clear previous errors
    if (emailError) emailError.textContent = "";
    if (passwordError) passwordError.textContent = "";
    if (result) result.textContent = "";

    // Regular expressions for validation
    let emailRegex = /^[^\s@]+@[^\s@]+\.[A-Za-z]{2,}$/;
    let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

    let isValid = true;

    if (!emailin || !emailin.value.trim() || !emailRegex.test(emailin.value.trim())) {
        if (emailError) emailError.innerHTML = `<p style="color: red; font-size: 14px;">Enter a valid email.</p>`;
        isValid = false;
    }

    if (!passwordin || !passwordin.value || !passwordRegex.test(passwordin.value)) {
        if (passwordError) passwordError.innerHTML = `<p style="color: red; font-size: 14px;">Password must be at least 8 characters long and contain at least one letter and one number.</p>`;
        isValid = false;
    }

    // If form is valid, submit via AJAX
    if (isValid) {
        result.innerHTML = "<p style='color: green; font-weight: bold;'>Signin complete!</p>";
        form.reset();  // Optionally reset the form after submission
        setTimeout(() => {
            window.location.href = '/makeupstore/home.html'; // Redirect to home page
        }, 3000);
        // AJAX request to submit form data to PHP
        let formData = new FormData(form);

        // Send data via AJAX to PHP script
        fetch('first.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  // Use text() to log the raw response
        .then(data => {
            console.log(data);  // Check the raw response from PHP
            try {
                data = JSON.parse(data);  // Try parsing the response manually
                if (data.success) {
                   
                } else {
                    result.innerHTML = `<p style="color: red; font-weight: bold;">${data.message}</p>`;  // Display error message
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        })
        .catch(error => {
            console.error('Error:', error);  // Log any errors that occur
        });
    }
}

// Attach event listener to form
document.addEventListener("DOMContentLoaded", function () {
    let form = document.querySelector("#signinform");
    if (form) {
        form.addEventListener("submit", validateForm);
    }
});

