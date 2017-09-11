<?php
declare(strict_types=1);

require_once('./src/Tranche.php');

use PHPUnit\Framework\TestCase;

/**
 * Test Investor Class
 */
final class InvestorTest extends TestCase {

  private $investor;

  public function setUp() {
    // Mock the Tranch Object
    $trancheMock = $this->createMock(Tranche::class);
    // Add on mocked object the `addAmount` method, which returns (void) NULL
    $trancheMock->method('addAmount')->willReturn(null);
    // Instantiate `Investor` object
    $amount = 1000;
    $this->investor = new Investor($amount, $trancheMock);
  }

  // Checks if Investor is trying to invest more money than he has in his wallet
  public function testCheckWallet() {
    $amount = 1000;
    $this->assertFalse($this->investor->checkWallet($amount));
  } 

  // Checks if when investor is trying to invest more money than he has, method `invest` throws an error
  // if no exception, nothing has to be returned
  public function testInvest() {
    $amount = 1000;
    $this->assertNull( $this->investor->invest($amount, '3/10/2015'));
  }

}

