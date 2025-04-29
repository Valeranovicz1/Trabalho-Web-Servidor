function toggleAccountMenu() {
    const dropdown = document.getElementById('accountDropdown');
    if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
    } else {
        dropdown.style.display = 'block';
    }
}

// Fecha o menu se o usuário clicar fora dele
window.addEventListener('click', function(event) {
    const dropdown = document.getElementById('accountDropdown');
    const accountIcon = document.querySelector('.account-icon');
    if (!dropdown.contains(event.target) && event.target !== accountIcon) {
        dropdown.style.display = 'none';
    }
})
;
