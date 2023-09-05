<?php

namespace App\Repositories;

use App\Models\Asset;
use App\Models\Code;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\Request;

class GenerateRepository
{
    public function downloadZip()
    {
        $zip_file = 'qrcode_'.date('dmyhis').'.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $path = storage_path('app/public');
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $key => $file)
        {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = 'qrcode/' . substr($filePath, strlen($path) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();

        Storage::delete(Storage::allFiles('public'));

        return response()->download($zip_file)->deleteFileAfterSend(true);
    }

    public function getArrayFromXls(Request $request)
    {
        $excelFile = $request->file('file');
        
        $obj = IOFactory::load($excelFile->path());

        $array = [];
        $wsheetnum  = 0;

        //Only sheet no 1 to be processed
        if ($wsheetnum < 1) {

            foreach ($obj->getWorksheetIterator() as $wsheet) {
                
                $wsheetnum += 1;
                $highestRow = $wsheet->getHighestRow(); 
               
                if($wsheetnum > 1)break;
                for($row=2; $row<=$highestRow; $row++) {
                    $array[$row-2]['code'] = $wsheet->getCellByColumnAndRow(1, $row)->getValue();
                    $array[$row-2]['name'] = $wsheet->getCellByColumnAndRow(2, $row)->getValue();
                    $array[$row-2]['phone'] = $wsheet->getCellByColumnAndRow(3, $row)->getValue();
                    $array[$row-2]['email'] = $wsheet->getCellByColumnAndRow(4, $row)->getValue();
                }
            }

        }

        return $array;
    }

    public function total()
    {
        $data['voucher'] = Code::count();
        $data['redeem'] = Code::whereStatus(Code::Redeem)->count();
        $data['notRedeem'] = Code::whereStatus(Code::NotRedeem)->count();
        return $data;
    }
}
