function openTab(event, tabName) {
    var i, tabcontent, tablinks;

    // Ocultar todo el contenido de las pestañas
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Eliminar la clase 'active' de todos los enlaces de pestañas
    tablinks = document.getElementsByClassName("tab-link");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Mostrar el contenido de la pestaña actual y añadir la clase 'active' al enlace de la pestaña
    document.getElementById(tabName).style.display = "block";
    event.currentTarget.className += " active";
}

// Función para cargar la primera pestaña por defecto al cargar la página
window.onload = function() {
    document.getElementsByClassName('tab-link')[0].click();
}
