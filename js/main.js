
function validateForm(event) {
    event.preventDefault(); // Prevent form from refreshing the page

    let form = event.target;
    let firstName = document.querySelector('input[name="Firstname"]');
    let secondName = document.querySelector('input[name="Secondname"]');
    let email = document.querySelector('input[name="Email"]');
    let password = document.querySelector('input[name="password"]');

    let firstNameError = firstName?.closest('.rowf')?.querySelector('.wrongf');
    let secondNameError = secondName?.closest('.rows')?.querySelector('.wrongs');
    let emailError = email?.closest('.rowe')?.querySelector('.wronge');
    let passwordError = password?.closest('.rowp')?.querySelector('.wrongp');

    let result = document.querySelector(".res");
    

    // Clear previous errors
    if (firstNameError) firstNameError.textContent = "";
    if (secondNameError) secondNameError.textContent = "";
    if (emailError) emailError.textContent = "";
    if (passwordError) passwordError.textContent = "";
    if(result) result.textContent = "";

    // Regular expressions for validation
    let emailRegex = /^[^\s@]+@[^\s@]+\.[A-Za-z]{2,}$/;
    let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

    let isValid = true;

    if (!firstName || !firstName.value.trim()) {
        if (firstNameError) firstNameError.innerHTML = `<p style="color: red; font-size: 14px;">First name is required.</p>`;
        isValid = false;
    }

    if (!secondName || !secondName.value.trim()) {
        if (secondNameError) secondNameError.innerHTML = `<p style="color: red; font-size: 14px;">Second name is required.</p>`;
        isValid = false;
    }

    if (!email || !email.value.trim() || !emailRegex.test(email.value.trim())) {
        if (emailError) emailError.innerHTML = `<p style="color: red; font-size: 14px;">Enter a valid email.</p>`;
        isValid = false;
    }


  

    if (!password || !password.value || !passwordRegex.test(password.value)) {
        if (passwordError) passwordError.innerHTML = `<p style="color: red; font-size: 14px;">Password must be at least 8 characters long and contain at least one letter and one number.</p>`;
        isValid = false;
    }

    // If form is valid, submit via AJAX
    if (isValid) {
        result.innerHTML = `<p style="color: green; font-weight: bold;">Signup complete!</p>`;
        form.reset();  // Optionally reset the form after submission
        setTimeout(() => {
            window.location.href = '/index.html'; // Redirect to home page
        }, 3000);
        // AJAX request to submit form data to PHP
        let formData = new FormData(form);

        // Send data via AJAX to PHP script
        fetch('second.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);  // You can display this data or show a success message

            try{
                data = JSON.parse(data);  // Try parsing the response manually
                if (data.success) {
                    
                } else {
                    result.innerHTML = `<p style="color: red; font-weight: bold;">${data.message}</p>`;  // Display error message
                }

            }catch (error) {
                console.error("Error parsing JSON:", error);
            }

        
        })
        .catch(error => {
            console.error('Error:', error);
        });




    }
}

// Attach event listener to form
document.addEventListener("DOMContentLoaded", function () {
    let form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", validateForm);
    }
});


