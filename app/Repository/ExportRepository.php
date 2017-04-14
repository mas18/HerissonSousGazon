<?php
/**
 * Created by PhpStorm.
 * User: teuft
 * Date: 14.04.2017
 * Time: 10:11
 */

namespace App\Repository;


use Maatwebsite\Excel\Facades\Excel;

class ExportRepository
{
    //export data. Either simple array or eloquent Model
    function exportXLS($eloquentModel, $fileName,$sheetName)
    {

        Excel::create($fileName, function($excel) use($eloquentModel,$sheetName) {
            $excel->sheet($sheetName, function($sheet) use($eloquentModel) {
                $sheet->fromModel($eloquentModel);
                $sheet->row(1, function($row) {
                    // call cell manipulation methods
                    $row->setFontWeight('bold');});
            });
        })->export('xls');
    }
}