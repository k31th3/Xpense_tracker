
<?php 
  /*
    Note: first value of array is default 

    1. type = [ "spinner-border", "spinner-glow" ]
    2. color = use text color utilities
    3. size = [ null, "spinner-border-sm", "spinner-glow-sm"] 
    4. align = [ null, "text-start", "text-center", "text-end"]
  */
  
  $data = array(
    "type" => "spinner-border",
    "color" => "text-light",
    "size" => null,
    "align" => null
  );

  $row = (!empty($construct))?array_merge($data, $construct):$data;

  $val = implode(" ", array_slice(array_values($row), 0, 3));
?>

<div class="<?=$row["align"]?>">
  <div class="<?=$val?>" role="status"></div>
</div>

