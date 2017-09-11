<?php
declare(strict_types=1);
/**
 * Investitor Class
 */
class Investor {

  private $wallet; 
  public  $tranche, $name;

  function __construct($wallet, Tranche $T) {
    // Add class properties
    $this->wallet  = $wallet; 
    $this->tranche = $T;
  }

  /**
   * Check if the investor has the necessary `$amount` in his wallet
   * @param - (amount) int
   * @return - boolean 
   */
  public function checkWallet($amount) {
    return $this->wallet-$amount < 0;
  }

  /**
   * Invest money(amount) into tranche
   * @param - (amount) int
   * @param - (date) string
   * @return - void
   */
  public function invest($amount, $date) {   
    if($this->checkWallet($amount)) {
      throw new Exception("Investor has spent all his money");
    }

    try {
      $this->tranche->addAmount($amount, $date);
      $this->wallet -= $amount;
    } catch(Exception $e) {
      throw $e;
    }
  }
}
