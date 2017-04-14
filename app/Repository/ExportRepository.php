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
    function exportXLS($eloquentModel)
    {

        Excel::create('utilisateurs', function($excel) use($eloquentModel) {
            $excel->sheet('utilisateurs', function($sheet) use($eloquentModel) {
                $sheet->fromModel($eloquentModel);
                $sheet->row(1, function($row) {
                    // call cell manipulation methods
                    $row->setFontWeight('bold');});
            });
        })->export('xls');
    }
}