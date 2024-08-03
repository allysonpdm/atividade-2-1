document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementById('integer');
    input.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});