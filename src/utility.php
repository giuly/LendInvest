<?php
/**
  * Utilities
  */
function getDaysByMonth(DateTime $begin, DateTime $end) {
  $daysPerMonth = array();
  for($i = $begin; $i < $end; $i->modify('+1 day')){
    if(!isset($daysPerMonth[$i->format("m")]['year'])) { $daysPerMonth[$i->format("m")]['year'] = $i->format("y"); }
    if(!isset($daysPerMonth[$i->format("m")]['days'])) { $daysPerMonth[$i->format("m")]['days'] = 0; }
    $daysPerMonth[$i->format("m")]['days'] += 1;
  }
  return $daysPerMonth;
}

/**
  * Debugging 
  */
function x($x) {
  echo '<pre>';
  print_r($x);
  echo '</pre>';
}