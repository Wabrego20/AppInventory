/**
 * Gráfica de Reportes por bodegas
 */
document.addEventListener('DOMContentLoaded', function () {
    const labels = data.map(item => item.warehouses_name);
    const quantities = data.map(item => parseInt(item.warehouses_total_quantity, 10));

    const totalQuantity = quantities.reduce((acc, curr) => acc + curr, 0);

    // Crear etiquetas con cantidades
    const labelsWithQuantities = data.map(item => `${item.warehouses_name} (${item.warehouses_total_quantity})`);

    // Función para generar colores aleatorios
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Generar colores aleatorios para cada cantidad
    const colors = quantities.map(() => getRandomColor());

    // Obtener el color de la variable CSS --azul
    const rootStyles = getComputedStyle(document.documentElement);
    const axisColor = rootStyles.getPropertyValue('--negro').trim();

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelsWithQuantities,
            datasets: [{
                label: '',
                data: quantities,
                backgroundColor: colors,
                borderColor: colors.map(color => color.replace('0.2', '1')),
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
