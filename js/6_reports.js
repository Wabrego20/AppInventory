/**
 * Gráfica de Reportes por bodegas
 */
document.addEventListener('DOMContentLoaded', function () {
    // Función para decodificar entidades HTML
    function decodeHtml(html) {
        const txt = document.createElement('textarea');
        txt.innerHTML = html;
        return txt.value;
    }
    // Datos de la primera gráfica
    const labels = data.map(item => decodeHtml(item.warehouses_name));
    const quantities = data.map(item => parseInt(item.warehouses_total_quantity, 10));
    const totalQuantity = quantities.reduce((acc, curr) => acc + curr, 0);
    // Crear etiquetas con cantidades
    const labelsWithQuantities = data.map(item => `${decodeHtml(item.warehouses_name)} (${item.warehouses_total_quantity})`);
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
                borderWidth: 0,
                borderRadius: 5
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

    // Datos de la segunda gráfica
    const labels2 = data2.map(item => decodeHtml(item.articles_name));
    const quantities2 = data2.map(item => parseInt(item.inventory_quantity, 10));
    const colors2 = quantities2.map(() => getRandomColor());

    const labelsWithQuantities2 = data2.map(item => `${decodeHtml(item.articles_name)} (${item.inventory_quantity})`);

    const ctx2 = document.getElementById('myPieChart').getContext('2d');
    const myPieChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: labelsWithQuantities2,
            datasets: [{
                data: quantities2,
                backgroundColor: colors2,
                borderColor: colors2.map(color => color.replace('0.2', '1')),
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'right', // Posicionar las etiquetas a la derecha
                    labels: {
                        boxWidth: 20,
                        padding: 15,
                        color: axisColor // Color de las etiquetas
                    }
                },
                title: {
                    display: true,
                    text: 'Distribución de Cantidades de Inventario por Artículo',
                    color: axisColor // Color del título
                }
            }
        }
    });
});

/**
 * Imprimir gráfica de reporte de bodegas
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

/**
 * Imprimir gráfica de inventario
 */
document.getElementById('print-button2').addEventListener('click', function () {
    const canvas = document.getElementById('myPieChart');
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