document.addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        document.querySelector('form').submit();
    }
});

document.getElementById('num1').addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9\-\.]/g, '');
});

document.getElementById('num2').addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9\-\.]/g, '');
});
