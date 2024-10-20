<!--// Contenido esencial de fpdf.php-->
<?php
class FPDF
{
    protected $y = 0; // Añadir una propiedad para la posición vertical
    protected $page = 0; // Añadir una propiedad para el número de página

    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        // Inicialización de parámetros
    }

    function AddPage($orientation = '', $size = '')
    {
        // Código para añadir una página
        $this->page++;
    }

    function SetFont($family, $style = '', $size = 0)
    {
        // Código para establecer la fuente
    }

    function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        // Código para crear una celda
        echo $txt . "<br>"; // Para propósitos de depuración
    }

    function Ln($h = null)
    {
        // Código para realizar un salto de línea
        if ($h === null)
            $h = 10; // Valor por defecto si no se especifica altura
        $this->y += $h;
    }

    function SetY($y)
    {
        // Código para establecer la posición vertical
        $this->y = $y;
    }

    function Image($file, $x, $y, $w = 0, $h = 0)
    {
        // Código para añadir una imagen
        echo "Imagen añadida: $file en ($x, $y) con tamaño ($w, $h)<br>"; // Para propósitos de depuración
    }

    function Output($dest = '', $name = '', $isUTF8 = false)
    {
        // Código para generar el PDF
        echo "PDF generado"; // Para propósitos de depuración
    }

    function PageNo()
    {
        // Código para obtener el número de página actual
        return $this->page;
    }
}

// Datos de ejemplo (deberías obtener estos datos de tu base de datos)
$solicitante = "Juan Pérez";
$elaborado_por = "Ana Gómez";
$cantidad = 1000;
date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d H:i:s');
$articulo = 'Papel blanco 8.5x11"';
$precio_unitario = 0.10; // Precio unitario de ejemplo
$precio_total = $cantidad * $precio_unitario;

class PDF extends FPDF
{
    function Header()
    {
        // Añadir el logo
        $this->Image('../img/logoMides.png', 10, 6, 30); // Ajusta la ruta y el tamaño según sea necesario
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Acta de Entrega', 0, 1, 'C');
        $this->Ln(20);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(0, 10, "Solicitante: $solicitante", 0, 1);
$pdf->Cell(0, 10, "Elaborado por: $elaborado_por", 0, 1);
$pdf->Cell(0, 10, "Cantidad: $cantidad", 0, 1);
$pdf->Cell(0, 10, "Fecha: $fecha", 0, 1);
$pdf->Cell(0, 10, "Articulo: $articulo", 0, 1);
$pdf->Cell(0, 10, "Precio Unitario: $$precio_unitario", 0, 1);
$pdf->Cell(0, 10, "Precio Total: $$precio_total", 0, 1);

// Espacio para firmas
$pdf->Ln(20);
$pdf->Cell(0, 10, "_________________________", 0, 1, 'L');
$pdf->Cell(0, 10, "Firma del Solicitante", 0, 1, 'L');
$pdf->Ln(10);
$pdf->Cell(0, 10, "_________________________", 0, 1, 'L');
$pdf->Cell(0, 10, "Firma del Elaborado", 0, 1, 'L');

$pdf->Output('D', 'acta_de_entrega.pdf');
?>