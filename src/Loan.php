<?php 
declare(strict_types=1);
/**
 * Loan Class
 */
class Loan {
  
  protected $startDate, $endDate;

  function __construct($startDate, $endDate) {
    // Create date objects and add them to class properties
    $this->startDate = DateTime::createFromFormat('d/m/Y', $startDate);
    $this->endDate   = DateTime::createFromFormat('d/m/Y', $endDate);
  }

  /**
   * Checks if the investor provided date is in the loan dates range
   * @param - string
   * @return - boolean 
   */
  public function checkAvailability($date) {
    $dateTime = DateTime::createFromFormat('d/m/Y', $date)->getTimestamp();
    $startDateTime = $this->startDate->getTimestamp();
    $endDateTime   = $this->endDate->getTimestamp();
    return ($dateTime >= $startDateTime && $dateTime <= $endDateTime);
  }

}