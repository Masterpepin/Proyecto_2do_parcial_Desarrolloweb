document.addEventListener('DOMContentLoaded', function() {
    // Espera a que el DOM esté completamente cargado antes de ejecutar el código

    // Obtén todas las filas de la tabla
    const rows = document.querySelectorAll('#data-table tbody tr');

    let totalVisitas = 0;
    let nacionales = 0;

    // Inicializa objetos para contar las ocurrencias de cada lengua
    let primeraLenguaContador = {};
    let segundaLenguaContador = {};

    rows.forEach(row => {
        totalVisitas++;
        // Obtén el texto de la celda de país de residencia
        const paisResidencia = row.cells[3].textContent.trim();
        if (paisResidencia === 'México') {
            nacionales++;
        }

        // Obtén las lenguas
        const primeraLengua = row.cells[7].textContent.trim();
        const segundaLengua = row.cells[8].textContent.trim();

        // Cuenta las ocurrencias de cada lengua
        if (primeraLengua) {
            if (!primeraLenguaContador[primeraLengua]) {
                primeraLenguaContador[primeraLengua] = 0;
            }
            primeraLenguaContador[primeraLengua]++;
        }

        if (segundaLengua) {
            if (!segundaLenguaContador[segundaLengua]) {
                segundaLenguaContador[segundaLengua] = 0;
            }
            segundaLenguaContador[segundaLengua]++;
        }
    });

    // Calcula el número de visitantes extranjeros
    const extranjeros = totalVisitas - nacionales;

    // Encuentra la lengua más frecuente
    const lenguaMasFrecuente = (contador) => {
        return Object.keys(contador).reduce((a, b) => contador[a] > contador[b] ? a : b);
    };

    const primeraLenguaMasFrecuente = lenguaMasFrecuente(primeraLenguaContador);
    const segundaLenguaMasFrecuente = lenguaMasFrecuente(segundaLenguaContador);

    // Actualiza los valores en el alert
    document.getElementById('total-visitas').textContent = totalVisitas;
    document.getElementById('nacionales').textContent = nacionales;
    document.getElementById('extranjeros').textContent = extranjeros;
    document.getElementById('primera-leng').textContent = `${primeraLenguaMasFrecuente} (${primeraLenguaContador[primeraLenguaMasFrecuente]})`;
    document.getElementById('segunda-leng').textContent = `${segundaLenguaMasFrecuente} (${segundaLenguaContador[segundaLenguaMasFrecuente]})`;
});
