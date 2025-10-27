// Extracted interactive JS from auth/login.blade.php
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');

    inputs.forEach(input => {
        input.addEventListener('focus', function() { this.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-20'); });
        input.addEventListener('blur', function() { this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-20'); });
        input.addEventListener('input', function() { if (this.value.length > 0) this.classList.add('border-green-300'); else this.classList.remove('border-green-300'); });
    });

    const form = document.querySelector('form');
    if (form) {
        const submitButton = form.querySelector('button[type="submit"]');
        form.addEventListener('submit', function() {
            if (submitButton) {
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Logging in...';
                submitButton.disabled = true;
                submitButton.classList.add('opacity-75', 'cursor-not-allowed');
            }
        });
    }

    const socialButtons = document.querySelectorAll('button[type="button"]');
    socialButtons.forEach(button => {
        button.addEventListener('mouseenter', function() { this.classList.add('transform', 'scale-105'); });
        button.addEventListener('mouseleave', function() { this.classList.remove('transform', 'scale-105'); });
    });
});
