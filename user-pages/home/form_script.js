// toggle password visibility
    function togglePasswordVisibility(inputId, toggleId) {
        var input = document.getElementById(inputId);
        var toggle = document.getElementById(toggleId);

        toggle.addEventListener('click', function() {
            if (input.type === 'password') {
                input.type = 'text';
                toggle.innerHTML = '<i class="fa-solid fa-eye"></i>';
            } else {
                input.type = 'password';
                toggle.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
            }
        });
    }
// check password strength
    function checkPasswordStrength(password) {
        var strength = 0;
        
        // Check length
        if (password.length >= 8) {
            strength += 1;
        }
        
        // Check for uppercase letters
        if (/[A-Z]/.test(password)) {
            strength += 1;
        }
        
        // Check for lowercase letters
        if (/[a-z]/.test(password)) {
            strength += 1;
        }
        
        // Check for numbers
        if (/\d/.test(password)) {
            strength += 1;
        }
        
        // Check for special characters
        if (/[^A-Za-z0-9]/.test(password)) {
            strength += 1;
        }
        
        // Update password strength indicator
        updatePasswordStrengthIndicator(strength);
        }
        
        function updatePasswordStrengthIndicator(strength) {
            var dashes = document.querySelectorAll('.dash');
            var strengthIndicator = document.getElementById('strengthIndicator')
            
            dashes.forEach(function(dash, index) {
                var color = 'transparent'; // Default to transparent
                var level = '';
                
                if (index < strength) {
                    if (strength >= 1) {
                        color = 'rgb(193, 6, 6)'; // Red if strength is 1 or more
                        strengthIndicator.innerText = 'weak';
                        strengthIndicator.style.color = color;
                    }
                    if (strength >= 2) {
                        color = 'rgb(246, 139, 30)'; // Orange if strength is 2 or more
                        strengthIndicator.innerText = 'medium';
                        strengthIndicator.style.color = color;
                    }
                    if (strength >= 3) {
                        color = 'rgb(2, 94, 2)'; // Green if strength is 3
                        strengthIndicator.innerText = 'strong';
                        strengthIndicator.style.color = color;
                    }
                }
                
                dash.style.backgroundColor = color;
            });
        }
        
        
        
        

// enable input in single characters at a time in each box

const inputs = document.querySelectorAll('.single-char-input');

inputs.forEach((input, index) => {
    input.addEventListener('input', () => {
        if (input.value.length > 1) {
            input.value = input.value.slice(0, 1);
        }
        if (input.value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });

    input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
            inputs[index - 1].focus();
        }
    });

const newPins = document.querySelectorAll('[name^="newPin[]"]');
    const confirmNewPins = document.querySelectorAll('[name^="newPin2[]"]');
    
    // Function to change input type to password when a character is input
    function changeInputType(input) {
        input.type = 'password';
    }

    // Add event listeners to new pin input fields
    newPins.forEach(input => {
        input.addEventListener('input', function() {
            changeInputType(this);
        });
    });

    // Function to check if new pin and confirm new pin match
    function pinsMatch() {
        let newPin = '';
        let confirmNewPin = '';

        newPins.forEach(input => {
            newPin += input.value;
        });

        confirmNewPins.forEach(input => {
            confirmNewPin += input.value;
        });
        return newPin === confirmNewPin;
    }

    // Add event listener to the last confirm new pin input field to trigger form submission
    confirmNewPins[5].addEventListener('input', function() {
        if (pinsMatch()) {
            document.getElementById('pinForm').submit();
        }
    });
});