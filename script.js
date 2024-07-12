document.addEventListener('DOMContentLoaded', function() {

    const rows = document.querySelectorAll('#data-table tbody tr');

    let totalVisitas = 0;
    let nacionales = 0;

    let primeraLenguaContador = {};
    let segundaLenguaContador = {};

    rows.forEach(row => {
        totalVisitas++;
        const paisResidencia = row.cells[3].textContent.trim();
        if (paisResidencia === 'México') {
            nacionales++;
        }

        const primeraLengua = row.cells[7].textContent.trim();
        const segundaLengua = row.cells[8].textContent.trim();

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

    const extranjeros = totalVisitas - nacionales;

    const lenguaMasFrecuente = (contador) => {
        return Object.keys(contador).reduce((a, b) => contador[a] > contador[b] ? a : b);
    };

    const primeraLenguaMasFrecuente = lenguaMasFrecuente(primeraLenguaContador);
    const segundaLenguaMasFrecuente = lenguaMasFrecuente(segundaLenguaContador);

    document.getElementById('total-visitas').textContent = totalVisitas;
    document.getElementById('nacionales').textContent = nacionales;
    document.getElementById('extranjeros').textContent = extranjeros;
    document.getElementById('primera-leng').textContent = `${primeraLenguaMasFrecuente} (${primeraLenguaContador[primeraLenguaMasFrecuente]})`;
    document.getElementById('segunda-leng').textContent = `${segundaLenguaMasFrecuente} (${segundaLenguaContador[segundaLenguaMasFrecuente]})`;
});

document.addEventListener('DOMContentLoaded', function () {
    const toggleFilters = document.getElementById('toggle-filters');
    const toggleIcon = document.getElementById('toggle-icon');
    const filters = document.getElementById('filters');

    toggleFilters.addEventListener('click', function () {
        filters.classList.toggle('d-none');
        toggleIcon.classList.toggle('rotate');
    });
});