<?php

namespace App\Imports;

use App\Models\Container;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class YourImportClass implements ToCollection
{
  /**
   * @param Collection $collection
   */
  public function collection(Collection $collection)
  {
    Container::truncate();
    $random = [];
    $jan = $collection->slice(1, 32);
    $fev = $collection->slice(38, 23);
    $mars = $collection->slice(65, 35);
    $avr = $collection->slice(106, 34);
    $mai = $collection->slice(142, 33);
    $juin = $collection->slice(178, 30);
    $juillet = $collection->slice(212, 25);
    $aout = $collection->slice(239, 30);
    $sept = $collection->slice(273, 29);
    $oct = $collection->slice(305, 24);
    $nov = $collection->slice(332, 28);

    $rows = collect();
    $rows = $rows->concat($jan);
    $rows = $rows->concat($fev);
    $rows = $rows->concat($mars);
    $rows = $rows->concat($avr);
    $rows = $rows->concat($mai);
    $rows = $rows->concat($juin);
    $rows = $rows->concat($juillet);
    $rows = $rows->concat($aout);
    $rows = $rows->concat($sept);
    $rows = $rows->concat($oct);
    $rows = $rows->concat($nov);

    $this->rander($rows->all(), $collection, $random);

     foreach($random  as $row){
      dump($row);
      dd('');
        Container::create([
          'CONSIGNEE'=> $row['CONSIGNEE ']
        ]);
     }
  }

  function rander($rows, $collection, &$random)
  {
    foreach ($rows as $row) {
//dump($row);
      $tableau = [
        $collection[0][1] => $row[1],
        $collection[0][2] . 'ISPAYE' => $row[2],
        $collection[0][3] => $row[3],
        // $collection[0][4]=>$row[4],
        $collection[0][5] => $row[5],
        $collection[0][6] => $row[6],
        $collection[0][7] => $row[7],
        $collection[0][8] => $row[8],
        $collection[0][9] => $row[9],
        $collection[0][10] => $row[10] !== null ? Date::excelToDateTimeObject($row[10])->format('Y-m-d') : null,
        $collection[0][11] => $row[11] !== null ? Date::excelToDateTimeObject($row[11])->format('Y-m-d') : null,
        $collection[0][12] => $row[12],
        $collection[0][13] => $row[13],
        $collection[0][14] => $row[14],
        $collection[0][15] => $row[15],
        $collection[0][16] => $row[16],
        $collection[0][17] => $row[17],
        $collection[0][18] => $row[18],
        $collection[0][19] => $row[19],
        $collection[0][20] => $row[20],
        $collection[0][21] => $row[21],
      ];

      $tableau = array_map(function ($key, $value) {
        return [trim($key) => trim($value)];
    }, array_keys($row), $row);

     array_push($random, $tableau);
    }
  }
}
