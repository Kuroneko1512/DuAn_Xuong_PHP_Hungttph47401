document.addEventListener('DOMContentLoaded', function() {
    const togglePasswordIcons = document.querySelectorAll('.toggle-password');
    togglePasswordIcons.forEach(function(icon) {
        icon.addEventListener('click', function() {
            const passwordField = icon.previousElementSibling;
            const isPasswordVisible = passwordField.getAttribute('data-visible') === 'true';
            if (isPasswordVisible) {
                passwordField.innerHTML = '*'.repeat(passwordField.getAttribute('data-password').length);
                passwordField.setAttribute('data-visible', 'false');
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                const adminPassword = prompt('Please enter admin password:');
                // Check if admin password matches
                if (adminPassword === 'admin123') {
                    passwordField.innerHTML = passwordField.getAttribute('data-password');
                    passwordField.setAttribute('data-visible', 'true');
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    alert('Incorrect admin password. Password not displayed.');
                }
            }
        });
    });
});