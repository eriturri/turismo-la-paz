(function() {

    // Espera a que la página cargue
    document.addEventListener('DOMContentLoaded', function() {

        const btnToggle = document.getElementById('btnModoOscuro');
        const body = document.body;

        // Si el botón no existe en esta página, no hacemos nada
        if (!btnToggle) {
            return;
        }

        // Función que actualiza el texto del botón
        function actualizarTextoBoton() {
            if (body.classList.contains('dark-mode')) {
                btnToggle.innerHTML = btnToggle.innerHTML.includes('🌙') ? '☀️ Modo Claro' : '☀️';
            } else {
                btnToggle.innerHTML = btnToggle.innerHTML.includes('☀️') ? '🌙 Modo Oscuro' : '🌙';
            }
        }

        // Función que aplica el modo (añade o quita la clase CSS)
        function aplicarModo(modo) {
            if (modo === 'dark') {
                body.classList.add('dark-mode');
            } else {
                body.classList.remove('dark-mode');
            }
            actualizarTextoBoton();
        }

        // 1. Al cargar la página: revisa si hay algo guardado
        const modoGuardado = localStorage.getItem('tema');
        if (modoGuardado) {
            aplicarModo(modoGuardado);
        }

        // 2. Al hacer clic: alterna el modo y guarda la preferencia
        btnToggle.addEventListener('click', function() {
            body.classList.toggle('dark-mode');

            // Revisa qué modo quedó activo y guárdalo
            let modoActual = body.classList.contains('dark-mode') ? 'dark' : 'light';
            localStorage.setItem('tema', modoActual);

            // Actualiza el texto del botón
            actualizarTextoBoton();
        });
    });

})();