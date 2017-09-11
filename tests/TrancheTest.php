<?php
declare(strict_types=1);

require_once('./src/Loan.php');

use PHPUnit\Framework\TestCase;

/**
 * Test Tranch Class
 */
final class TrancheTest extends TestCase {

  private $tranche;

  public function setUp() {   
    // Mock the Loan Object
    $loanMock = $this->createMock(Loan::class);
    // Add on mocked object the `checkAvailability` method, which returns TRUE
    $loanMock->method('checkAvailability')->willReturn(true);
    // Instantiate `Tranche` object
    // - interest rate of 3%
    // - max. amount of 1000
    $this->tranche = new Tranche(3, 1000, $loanMock);
  }

  // Checks if the maximum amount of money has been reached
  public function testCheckMaxAmount() {
    $amount = 1000;
    $this->assertTrue($this->tranche->checkMaxAmount($amount));
  } 

  // Checks if `addAmount` method throws exception when max. amount has been reached
  // if no exception, nothing has to be returned
  public function testAddAmount() {
    $amount = 1000;
    $date   = '3/10/2015';
    $this->assertNull( $this->tranche->addAmount($amount, $date));
  }

  // Checks if `getProfit` method returns the right gain
  public function testGetProfit() {
    $month = 10;
    $year  = 2017;
    $numberOfDays = 29;
    $amount = 1000;
    $this->assertEquals('28.06', $this->tranche->getProfit($month, $year, $numberOfDays, $amount));
  }

}

