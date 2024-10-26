/**
 * Gráfica de Reportes
 */
document.addEventListener('DOMContentLoaded', function () {
    const labels = data.map(item => item.warehouses_name);
    const quantities = data.map(item => parseInt(item.warehouses_total_quantity, 10));

    const totalQuantity = quantities.reduce((acc, curr) => acc + curr, 0);

    // Lista de colores
    const rootStyles = getComputedStyle(document.documentElement);
    const colors = [
        rootStyles.getPropertyValue('--amarillo').trim(),
        rootStyles.getPropertyValue('--naranja').trim(),
        rootStyles.getPropertyValue('--verde').trim(),
        rootStyles.getPropertyValue('--cian').trim(),
        rootStyles.getPropertyValue('--morado').trim(),
        rootStyles.getPropertyValue('--rosa').trim(),
        rootStyles.getPropertyValue('--gris').trim(),
        rootStyles.getPropertyValue('--marron').trim(),
        rootStyles.getPropertyValue('--azul').trim(),
        rootStyles.getPropertyValue('--rojo').trim()
    ];

    const axisColor = rootStyles.getPropertyValue('--azul').trim();
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '',
                data: quantities,
                backgroundColor: colors.slice(0, quantities.length),
                borderColor: colors.slice(0, quantities.length).map(color => color.replace('0.2', '1')),
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false // Desactivar la leyenda
                },
                title: {
                    display: true,
                    text: `Cantidad Total de Artículos: ${totalQuantity}`,
                    color: axisColor // Color del título
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: axisColor
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: axisColor
                    }
                }
            }
        }
    });
});


/**
 * Imprimir grafica de reporte de bodegas
 */

document.getElementById('print-button').addEventListener('click', function () {
    const canvas = document.getElementById('myChart');
    const dataUrl = canvas.toDataURL();
    const windowContent = `
        <html>
        <head><title>Imprimir Gráfica</title></head>
        <body>
            <img src="${dataUrl}">
        </body>
        </html>`;
    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.open();
    printWindow.document.write(windowContent);
    printWindow.document.close();
    printWindow.onload = function () {
        printWindow.print();
        printWindow.close();
    };
});
