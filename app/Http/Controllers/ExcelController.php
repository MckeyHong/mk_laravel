<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Excel;

class ExcelController extends Controller
{
    /**
     * 介面：匯出Excel
     * ref：http://www.maatwebsite.nl/laravel-excel/docs
     * @return layout Excel
     */
    public function getIndex()
    {
        //要塞入的資料
        $data = [];
        for ($no = 1 ; $no <= 60 ; $no+=2) {
            $data[] = ['資料_'.$no, '資料_'.($no+1)];
        }
        //產生要輸出的Excel
        Excel::create('mk_laravel', function($excel) use($data) {
            $excel->sheet('demo1', function($sheet) use($data) {
                $sheet->fromArray($data);
                /* 表頭設定 */
                $sheet->row(1, ['filed1', 'filed2']);
                $sheet->row(1, function($row) {
                    //字體顏色
                    $row->setFontColor('#ffffff');
                    //背景顏色
                    $row->setBackground('#000000');
                });
                //字型設定
                $sheet->setFontFamily('Comic Sans MS');
                //字型大小
                $sheet->setFontSize(12);
                //字型粗細
                $sheet->setAllBorders('thin');
                //第一列凍結
                $sheet->freezeFirstRow();
                //調整欄位大小
                $sheet->setAutoSize(true);
            });
        })->export('xls');
    }

}
