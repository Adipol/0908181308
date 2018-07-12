<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Product;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Output;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataExport implements WithColumnFormatting,FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    use Exportable;

    public function collection()
    {   
        $user     = auth()->user()->id;
    
        if (session('justification_id')) {
        
            return Output::join('warehouses','outputs.warehouse_id','=','warehouses.id')
            ->join('users','outputs.applicant_id','=','users.id')
            ->select('outputs.created_at','users.name','warehouses.name as w_name','outputs.description_j')
            ->whereBetween('outputs.created_at',[session('from'),session('to')])
            ->whereIn('outputs.status',['APPROVED','DELIVERED'])
            ->where('approve',$user)
            ->whereIn('outputs.id',function($query){
            $value = session()->get('justification_id');
            $query->select('justification_output.output_id')
                ->from('justification_output')->where('justification_output.justification_id',$value);
        })
        ->orderBy('outputs.id','asc');
        }else{
            return Output::join('warehouses','outputs.warehouse_id','=','warehouses.id')
            ->join('users','outputs.applicant_id','=','users.id')
            ->select('outputs.created_at','users.name','warehouses.name as w_name','outputs.description_j')
            ->whereBetween('outputs.created_at',[session('from'),session('to')])
            ->whereIn('outputs.status',['APPROVED','DELIVERED'])
            ->where('approve',$user)
            ->orderBy('outputs.id','asc');
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha de solicitud',
            'Solicitante',
            'Almacén',
            'Descripción de justificación',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}