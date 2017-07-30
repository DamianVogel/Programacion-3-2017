<?php

class TablaPDF extends FPDF
{
//CARGA DE DATOS
    //EMPLEADOS
        function LoadData()
        {
            $usuarios = Usuario::TraerTodosLosusuarios();
            return $usuarios;
        }

        function LoadDataReportLog()
        {
            $usuarios = array();
            $usuarios = Reportes::ReportLogEmpleados();
            return $usuarios;
        }

        function LoadDataReportSumOpEmpleados()
        {
            $usuarios = array();
            $usuarios = Reportes::ReportSumOpEmpleados();
            return $usuarios;
        }
    //COCHERAS
        function LoadDataReportCochMasUt()
        {
            $cocheras = array();
            $cocheras = Reportes::ReportCocheraMasUtil();
            return $cocheras;
        }

        function LoadDataReportCochMenosUt()
        {
            $cocheras = array();
            $cocheras = Reportes::ReportCocheraMenosUtil();
            return $cocheras;
        }

        function LoadDataReportCocheraSinUtil()
        {
            $cocheras = array();
            $cocheras = Reportes::ReportCocheraSinUtil();
            return $cocheras;
        }
    //VEHICULOS
        function LoadDataReportVehiculos()
        {
            $usuarios = array();
            $usuarios = Reportes::ReportVehiculos();
            return $usuarios;
        }
//FORMATO DE TABLAS
    //USUARIOS
            function TablaUsuarios($header, $data)
            {
                // Colores, ancho de línea y fuente en negrita
                $this->SetFillColor(255,0,0);
                $this->SetTextColor(255);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                $this->SetFont('','B');
                // Cabecera
                $w = array(40, 35, 45, 40);
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                $this->Ln();
                // Restauración de colores y fuentes
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Datos
                $fill = false;
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row->id_empleado,'LR');
                    $this->Cell($w[1],6,$row->nombre,'LR');
                    $this->Cell($w[2],6,$row->tipo,'LR');
                    $this->Cell($w[3],6,$row->turno,'LR');
                    $this->Ln();
                    $fill = !$fill;
                }
                // Línea de cierre
                $this->Cell(array_sum($w),0,'','T');
            }

            function TablaReportLogEmp($header, $data)
            {
                // Colores, ancho de línea y fuente en negrita
                $this->SetFillColor(128,128,128);
                $this->SetTextColor(255);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                $this->SetFont('','B');
                // Cabecera
                $w = array(30, 20, 30, 20, 20, 20, 20 );
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                $this->Ln();
                // Restauración de colores y fuentes
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Datos
                $fill = false;

                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row->{'NOMBRE_EMPLEADO'},'LR');
                    $this->Cell($w[1],6,$row->{'TURNO'},'LR');
                    $this->Cell($w[2],6,$row->{'ESTADO'},'LR');
                    $this->Cell($w[3],6,$row->{'FECHA'},'LR');
                    $this->Cell($w[4],6,$row->{'HORA_ENTRADA'},'LR');
                    $this->Cell($w[5],6,$row->{'HORA_SALIDA'},'LR');
                    $this->Cell($w[6],6,$row->{'CANTIDAD_HORAS'},'LR');
                    $this->Ln();
                    $fill = !$fill;
                }
                // Línea de cierre
                $this->Cell(array_sum($w),0,'','T');
            }

            function TablaReportSumOpEmp($header, $data)
            {
                // Colores, ancho de línea y fuente en negrita
                $this->SetFillColor(128,0,128);
                $this->SetTextColor(255);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                $this->SetFont('','B');
                // Cabecera
                $w = array(30, 30);
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                $this->Ln();
                // Restauración de colores y fuentes
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Datos
                $fill = false;

                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row->{'NOMBRE_EMPLEADO'},'LR');
                    $this->Cell($w[1],6,$row->{'CANTIDAD_OPERACIONES'},'LR');
                    $this->Ln();
                    $fill = !$fill;
                }
                // Línea de cierre
                $this->Cell(array_sum($w),0,'','T');
            }

    //COCHERAS
        function TablaReportCochera($header, $data)
        {
            // Colores, ancho de línea y fuente en negrita
            $this->SetFillColor(255,0,0);
            $this->SetTextColor(255);
            $this->SetDrawColor(128,0,0);
            $this->SetLineWidth(.3);
            $this->SetFont('','B');
            // Cabecera
            $w = array(30, 40);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Ln();
            // Restauración de colores y fuentes
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Datos
            $fill = false;

            foreach($data as $row)
            {
                $this->Cell($w[0],6,$row->{'NRO_COCHERA'},'LR');
                $this->Cell($w[1],6,$row->{'CANTIDAD_OPERACIONES'},'LR');
                $this->Ln();
                $fill = !$fill;
            }
            // Línea de cierre
            $this->Cell(array_sum($w),0,'','T');
        }
    
    //VEHICULOS
        function TablaReportVehic($header, $data)
            {
                // Colores, ancho de línea y fuente en negrita
                $this->SetFillColor(200,0,0);
                $this->SetTextColor(255);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                $this->SetFont('','B');
                // Cabecera
                $w = array(20, 20, 30, 30, 35, 35, 20 );
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                $this->Ln();
                // Restauración de colores y fuentes
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Datos
                $fill = false;

                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row->{'NRO_COCHERA'},'LR');
                    $this->Cell($w[1],6,$row->{'PATENTE'},'LR');
                    $this->Cell($w[2],6,$row->{'COLOR'},'LR');
                    $this->Cell($w[3],6,$row->{'MARCA'},'LR');
                    $this->Cell($w[4],6,$row->{'FECHA_INGRESO'},'LR');
                    $this->Cell($w[5],6,$row->{'FECHA_SALIDA'},'LR');
                    $this->Cell($w[6],6,$row->{'IMPORTE'},'LR');
                    $this->Ln();
                    $fill = !$fill;
                }
                // Línea de cierre
                $this->Cell(array_sum($w),0,'','T');
            }

}
        
