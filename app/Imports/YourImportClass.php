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

    $this->rander($rows->slice(0,321), $collection, $random);

     foreach($random  as $row){
        $data = $this->remplacerEspacesParUnderscores($row);
        $data['TELEX_DOC'] = $data['TELEX_DOC']==='TELEX/DOC' ? '1' : '0';
        Container::create($data);
       // dump($row);
     }
  }

  function rander($rows, $collection, &$random)
  {
    foreach ($rows as $row) {

      $tableau = [
        trim($collection[0][1]) => $row[1],
        trim($collection[0][2]) . 'ISPAYE' => $row[2],
        trim($collection[0][3]) => $row[3],
        // $collection[0][4]=>$row[4],
        trim($collection[0][5]) => $row[5],
        trim($collection[0][6]) => $row[6],
        trim($collection[0][7]) => $row[7],
        trim($collection[0][8]) => $row[8],
        trim($collection[0][9]) => $row[9],
        trim($collection[0][10]) => $row[10] !== null ? Date::excelToDateTimeObject($row[10])->format('Y-m-d') : null,
        trim($collection[0][11]) => $row[11] !== null ? Date::excelToDateTimeObject($row[11])->format('Y-m-d') : null,
        trim($collection[0][12]) => $row[12],
        trim($collection[0][13]) => $row[13],
        trim($collection[0][14]) => $row[14],
        trim($collection[0][15]) => $row[15],
        trim($collection[0][16]) => $row[16],
        trim($collection[0][17]) => $row[17],
        trim($collection[0][18]) => $row[18],
        trim($collection[0][19]) => $row[19],
        trim($collection[0][20]) => $row[20],
        trim($collection[0][21]) => $row[21],
      ];


     array_push($random, $tableau);
    }
  }

  function remplacerEspacesParUnderscores($tableauAssociatif) {
    $nouveauTableau = array();

    foreach ($tableauAssociatif as $cle => $valeur) {
        // Remplacer les espaces par des underscores dans la clé
        $nouvelleCle = str_replace(' ', '_', $cle);

        // Retirer les caractères "/"
        $nouvelleCle = str_replace('/', '', $nouvelleCle);

        // Ajouter la paire clé-valeur au nouveau tableau
        $nouveauTableau[$nouvelleCle] = $valeur;
    }

    return $nouveauTableau;
}
}
