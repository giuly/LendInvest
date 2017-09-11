<?php
declare(strict_types=1);

/**
 * Tranche Class
 */
class Tranche {

  private $monthlyInterest, $maxAmount;
  public  $loan, $name;

  function __construct($monthlyInterest, $maxAmount, Loan $L) {
    // Add class properties
    $this->monthlyInterest = $monthlyInterest;
    $this->maxAmount       = $maxAmount;
    $this->loan            = $L; 
  }

  /**
   * Check if the invested amount doesn't exceed the maximum allowed amount on this tranche
   * @param - integer
   * @return - boolean 
   */
  public function checkMaxAmount($amount) {
    return $this->maxAmount-$amount >= 0; 
  }

  /**
   * Add $amount to tranche
   * @param - (amount) int
   * @param - (date) string
   * @return - void
   */
  public function addAmount($amount, $date) {
    if(!$this->loan->checkAvailability($date)) { // check if the date is in the loan range 
      throw new Exception("Date out of range");
    } else if(!$this->checkMaxAmount($amount)) { // check if the invested sum doesn't exceed the max amount
      throw new Exception("Maximum amount reached");
    }
    $this->maxAmount -= $amount;
  }

  /**
   * Get the profit on this tranche
   * @param - (month) int
   * @param - (year) int
   * @param - (numberOfDays) int
   * @param - (amount) int
   * @return - (profit) float   
   */
  public function getProfit($month, $year, $numberOfDays, $amount) {
    $numberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $profit = round((($this->monthlyInterest/100*$amount) / $numberOfDaysInMonth) * $numberOfDays, 2);
    return $profit;
  }

}
