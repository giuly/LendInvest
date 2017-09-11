<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Test Loan Class
 */
final class LoanTest extends TestCase {

  private $loan;
  
  public function setUp() {
    // Instantiate the loan available between '1/10/2015' and '15/10/2015'
    $this->loan = new Loan('1/10/2015', '15/10/2015');
  }

  // Checks if the Investos's date is in Loan date range
  public function testCheckAvailability() {
    $date = '15/10/2015';
    $this->assertTrue($this->loan->checkAvailability($date));
  }      

}

