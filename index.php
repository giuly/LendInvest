<?php 

// Import clases
require_once('./src/Loan.php');
require_once('./src/Tranche.php');
require_once('./src/Investor.php');

// Import utilities
require_once('./src/utility.php');

/**
 * System Logic
 */
// loan
$loan = new Loan('01/10/2015', '15/11/2015');

// each tranche 
$ATranche = new Tranche(3, 1000, $loan);
$ATranche->name = 'A';
$BTranche = new Tranche(6, 1000, $loan);
$BTranche->name = 'B';

// each investitor
$investor1 = new Investor(1000, $ATranche);
$investor1->name = 'Investor 1';
$investor2 = new Investor(1000, $ATranche);
$investor2->name = 'Investor 2';
$investor3 = new Investor(1000, $BTranche);
$investor3->name = 'Investor 3';
$investor4 = new Investor(1000, $BTranche);
$investor4->name = 'Investor 4';

// Add all investors instances to an array
$investors = array(
  array(
    'obj' => $investor1,
    'amount' => 1000,
    'date' => '03/10/2015'
  ),
  array(
    'obj' => $investor2,
    'amount' => 1,
    'date' => '04/10/2015'
  ),
  array(
    'obj' => $investor3,
    'amount' => 500,
    'date' => '10/10/2015'
  ),
  array(
    'obj' => $investor4,
    'amount' => 1100,
    'date' => '25/10/2015'
  )
);

/**
 * Calculate each Investor's gain
 * @param (date) string
 * @param (investor) array
 * @return void
 */
function calculateInvestorsInterest($date, $investors) {

  foreach ($investors as $key => $investor) {
    $investors[$key]['profit'] = 0;
    try {
      // Invest
      $investor['obj']->invest($investor['amount'], $investor['date']);
      x("(OK) Investor: " . $investor['obj']->name. " has just invested ". $investor['amount'] . " on Tranche: ".$investor['obj']->tranche->name);
    
      $begin = DateTime::createFromFormat('d/m/Y', $investor['date']);
      $end   = DateTime::createFromFormat('d/m/Y', $date);
     
      // Split by month the number of days when an Investor invest
      $daysPerMonth = getDaysByMonth($begin, $end);

      foreach ($daysPerMonth as $month => $numberOfDays) {
        // Get Profit
        $investors[$key]['profit'] +=  $investor['obj']->tranche->getProfit((int)$month, (int)$numberOfDays['year'], $numberOfDays['days'], $investor['amount']);
      }

    } catch(Exception $e) {
      x("(X)  Investor: ". $investor['obj']->name . " - " . $e->getMessage());
    }
  }

  showProfit($investors, $date);
}

/**
 * Display profit per Investor
 * @param - (investors) array
 * @param - (date) string
 * @return void
 */
function showProfit($investors, $date) {
  foreach ($investors as $investor) {
    if($investor['profit'] != 0) {
      x($investor['obj']->name .' has won: '. $investor['profit'] .' form  Tranche: '. $investor['obj']->tranche->name.' during '. $investor['date'] .' - '. $date);
    }
  }
}

// Runs the interest calculation for the period 01/10/2015 -> 31/10/2015
calculateInvestorsInterest('1/11/2015', $investors);

?>