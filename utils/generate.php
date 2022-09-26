<?
    $jsondata = file_get_contents('php://input');
    $data =json_decode($jsondata,true);
    require_once __DIR__ . '/PHPExcel-1.8/Classes/PHPExcel.php';
    require_once __DIR__ . '/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';
    //var_dump($data);
    require_once './get_text.php';
    require_once 'get_img_list.php';
    $xls = new PHPExcel();

    $xls->setActiveSheetIndex(0);
    $sheet = $xls->getActiveSheet();
    $sheet->setTitle('items');

    $sheet->setCellValueByColumnAndRow(0,1, "Id");
    $sheet->setCellValueByColumnAndRow(1,1, "Category");
    $sheet->setCellValueByColumnAndRow(2,1, "GoodsType");
    $sheet->setCellValueByColumnAndRow(3,1, "Address");
    $sheet->setCellValueByColumnAndRow(4,1, "Title");
    $sheet->setCellValueByColumnAndRow(5,1, "Description");
    $sheet->setCellValueByColumnAndRow(6,1, "Condition");
    $sheet->setCellValueByColumnAndRow(7,1, "Price");
    $sheet->setCellValueByColumnAndRow(8,1, "DateBegin");
    $sheet->setCellValueByColumnAndRow(9,1, "DateEnd");
    $sheet->setCellValueByColumnAndRow(10,1, "AllowEmail");
    $sheet->setCellValueByColumnAndRow(11,1, "ManagerName");
    $sheet->setCellValueByColumnAndRow(12,1, "ContactPhone");
    $sheet->setCellValueByColumnAndRow(13,1, "AdType");
    $sheet->setCellValueByColumnAndRow(14,1, "ImageUrls");
    $sheet->setCellValueByColumnAndRow(15,1, "GoodsSubType");
    $sheet->setCellValueByColumnAndRow(16,1, "ContactMethod");
    $sheet->setCellValueByColumnAndRow(17,1, "AdStatus");
    $sheet->setCellValueByColumnAndRow(18,1, "RCSlabType");

    $i = 2;
    $cur_date = date("Y-m-d");
    foreach ($data as $item){
        //var_dump($item);
 
    $end_date = date("Y-m-d",strtotime($cur_date.' + '.$item['days_count'].' days'));
        $sheet->setCellValueByColumnAndRow(0,$i, uniqid());//;$item["id"]);
        $sheet->setCellValueByColumnAndRow(1,$i, "Ремонт и строительство");
        $sheet->setCellValueByColumnAndRow(2,$i, "Стройматериалы");
        $sheet->setCellValueByColumnAndRow(3,$i, $item["place"]);
        $sheet->setCellValueByColumnAndRow(4,$i, $item["title"]);
        $sheet->setCellValueByColumnAndRow(5,$i, get_text($item["description"],$item["title"],$item["price"]));
        $sheet->setCellValueByColumnAndRow(6,$i, "Новое");
        $sheet->setCellValueByColumnAndRow(7,$i, $item["price"]);
        $sheet->setCellValueByColumnAndRow(8,$i, $cur_date.'T'.$item["time"]);
        $sheet->setCellValueByColumnAndRow(9,$i, $end_date.'T'.$item["time"]);
        $sheet->setCellValueByColumnAndRow(10,$i, "Да");
        $sheet->setCellValueByColumnAndRow(11,$i, $item["managerName"]);
        $sheet->setCellValueByColumnAndRow(12,$i, $item["phone"]);
        $sheet->setCellValueByColumnAndRow(13,$i, "Товар приобретен на продажу");
        $sheet->setCellValueByColumnAndRow(14,$i, get_img_list($item["images"]));
        $sheet->setCellValueByColumnAndRow(15,$i, $item["subtype"]);
        $sheet->setCellValueByColumnAndRow(16,$i, $item["contactMethod"]);
        $sheet->setCellValueByColumnAndRow(17,$i, $item["adStatus"]);
        $sheet->setCellValueByColumnAndRow(18,$i, $item["gbt"]);

        $i+=1;
    }
    $objWriter = new PHPExcel_Writer_Excel2007($xls);
    $objWriter->save('../file.xlsx');

    echo "<a href='file.xlsx' download>Готовый файл</a>";
?>