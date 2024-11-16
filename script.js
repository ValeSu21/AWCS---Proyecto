// Simulación de funcionalidad de búsqueda
document.querySelector('.search-bar button').addEventListener('click', function() {
    const searchTerm = document.querySelector('.search-bar input').value;
    if (searchTerm) {
        alert(`Buscando: ${searchTerm}`);
    } else {
        alert("Por favor, ingrese un término de búsqueda.");
    }
});

// Simulación de funcionalidad de iconos de usuario y carrito
document.querySelector('.user-cart img:nth-child(1)').addEventListener('click', function() {
    alert("Iniciar sesión en tu cuenta.");
});

document.querySelector('.user-cart img:nth-child(2)').addEventListener('click', function() {
    alert("Accediendo al carrito de compras.");
});
