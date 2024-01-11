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
    $rows = $collection->slice(4, 355);
    $this->rander($rows->slice(0, 351), $collection, $random);
    
     foreach($random  as $row){
        $data = $this->remplacerEspacesParUnderscores($row);
        $data['TELEX_DOC'] = $data['TELEX_DOC']==='TELEX/DOC' ? '1' : '0';
        Container::create($data);
     }     
   return redirect()->to('/');
  }

  function rander($rows, $collection, &$random)
  {

    foreach ($rows as $key => $row) {
      
      $tableau = [
        trim($collection[2][1]) => $row[1],
        trim($collection[2][2]) . 'ISPAYE' => $row[2] ==='*' ? true : false,
        trim($collection[2][3]) => $row[3],
        trim($collection[2][5]) => $row[5],
        trim($collection[2][6]) => $row[6],
        trim($collection[2][7]) => $row[7],
        trim($collection[2][8]) => $row[8],
        trim($collection[2][9]) => $row[9],
        trim($collection[2][10]) => $row[10] !== null ? Date::excelToDateTimeObject($row[10])->format('Y-m-d') : null,
        trim($collection[2][11]) => $row[11] !== null ? Date::excelToDateTimeObject($row[11])->format('Y-m-d') : null,
        trim($collection[2][12]) => $row[12],
        trim($collection[2][13]) => $row[13],
        trim($collection[2][14]) => $row[14],
        trim($collection[2][15]) => $row[15],
        trim($collection[2][16]) => $row[16],
        trim($collection[2][17]) => $row[17],
        trim($collection[2][18]) => $row[18],
        trim($collection[2][19]) => $row[19],
        trim($collection[2][20]) => $row[20],
        trim($collection[2][21]) => $row[21],
      ];
     array_push($random, $tableau);
    }
  }

  function remplacerEspacesParUnderscores($tableauAssociatif) {
    $nouveauTableau = array();
    foreach ($tableauAssociatif as $cle => $valeur) {
        $nouvelleCle = str_replace(' ', '_', $cle);
        $nouvelleCle = str_replace('/', '', $nouvelleCle);
        $nouveauTableau[$nouvelleCle] = $valeur;
    }
    return $nouveauTableau;
}
}
