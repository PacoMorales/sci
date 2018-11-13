<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\ponderacionModel;

class ExcelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ponderacionModel::join('SCI_PROCESOS','SCI_PONDERACION.CVE_PROCESO','=','SCI_PROCESOS.CVE_PROCESO')
                                ->select('SCI_PROCESOS.ESTRUCGOB_ID','SCI_PROCESOS.CVE_DEPENDENCIA','SCI_PROCESOS.CVE_PROCESO','SCI_PROCESOS.CVE_TIPO_PROC','SCI_PROCESOS.DESC_PROCESO','SCI_PROCESOS.RESPONSABLE','SCI_PONDERACION.POND_NGCI1','SCI_PONDERACION.POND_NGCI2','SCI_PONDERACION.POND_NGCI3','SCI_PONDERACION.POND_NGCI4','SCI_PONDERACION.POND_NGCI5')
                                ->orderBy('SCI_PROCESOS.CVE_PROCESO','ASC')
                                ->get();
    }
}
