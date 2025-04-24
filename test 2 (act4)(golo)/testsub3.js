function validateForm() {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm').value;

    if (password !== confirm) {
        alert("Passwords do not match!");
        return false;
    }

    return true;
}

// Optional: Allow Enter key to submit the form
document.addEventListener('keydown', function(event) {
    if (event.key === "Enter") {
        document.querySelector('form').submit();
    }
});
