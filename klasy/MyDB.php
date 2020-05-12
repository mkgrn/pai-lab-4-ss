<?php
class MyDB extends mysqli
{
  function getQuerySingleResult($query)
  {
    //Wykonanie zapytania.
    if(!$result = $this->query($query)){
      //echo 'Wyst�pi� b��d (getQuerySingleResult): nieprawid�owe zapytanie...';
      return false;
    }
    if($row = $result->fetch_row()){
      //Zwr�cenie wyniku.
      return $row[0];
    }
    else{
      //Brak wynik�w zapytania.
      return false;
    }
  }
  
  function getQueryResultAsTableRows($query, $colNames = false, $colNamesAsTh = true)
  {
    //Odrzucone zapytanie
    if(!$result = $this->query($query)) return false;
    if(!$columns = $result->fetch_fields()) return false;
    
    //Zmienna przechowuj�ca wynik dzia�ania metody.
    $str = '';
    
    //Uzyskanie nazw kolumn, o ile potrzebne.
    if($colNames){
      $str .= '<tr>';
      $tag = $colNamesAsTh ? 'th':'td';
      foreach($columns as $col){
        $str .= "<$tag>{$col->name}</$tag>";
      }
      $str .= '</tr>';
    }
    
    //Uzyskanie wynik�w zapytania.
    while($row = $result->fetch_row()){
      $str .= '<tr>';
      foreach($row as $val){
        $str .= "<td>$val</td>";
      }
      $str .= '</tr>';
    }
    
    //Zwr�cenie ostatecznego wyniku.
    return $str;
  }
  
  function getPagination($page, $pages, $link, $msg)
  {
    $str = '';
    for($i = 0; $i < $pages; $i++){
      if($i != $page){
        $str .= "<a href=\"$link&amp;page=$i\">".($i+1)."</a>";
      }
      else{
        $str .= '<span class="activePaginationPage">' . ($i+1)
              . '</span>';
      }
      $str .= '<span class="space"> </span>';
    }
    $str = $msg . $str;
    return $str;
  }
  
}
?>