<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\ponderacionModel;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromCollection, /*FromQuery,*/ WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'SECRETARIA',
            'UNIDAD_ADMINISTRATIVA',
            'PROCESO',
            'TIPO_PROCESO',
            'DESCRIPCION_PROCESO',
            'RESPONSABLE',
            'PONDERACION_NORMA_1',
            'PONDERACION_NORMA_2',
            'PONDERACION_NORMA_3',
            'PONDERACION_NORMA_4',
            'PONDERACION_NORMA_5'
        ];
    }

    public function collection()
    {
        return ponderacionModel::join('SCI_PROCESOS','SCI_PONDERACION.CVE_PROCESO','=','SCI_PROCESOS.CVE_PROCESO')
                                ->select('SCI_PROCESOS.ESTRUCGOB_ID','SCI_PROCESOS.CVE_DEPENDENCIA','SCI_PROCESOS.CVE_PROCESO','SCI_PROCESOS.CVE_TIPO_PROC','SCI_PROCESOS.DESC_PROCESO','SCI_PROCESOS.RESPONSABLE','SCI_PONDERACION.POND_NGCI1','SCI_PONDERACION.POND_NGCI2','SCI_PONDERACION.POND_NGCI3','SCI_PONDERACION.POND_NGCI4','SCI_PONDERACION.POND_NGCI5')
                                ->orderBy('SCI_PROCESOS.CVE_PROCESO','ASC')
                                ->get();
    }
}
