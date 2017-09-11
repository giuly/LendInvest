# LendInvest

In LendInvest we think everyone should have the opportunity to invest in property, which is
why we’re disrupting the status quo. This is lending and investing without the banks.
Mortgages simplified. We connect people who want to invest their money, with investments to
those who want to borrow

## Model

- Each of our loans has a start date and an end date.
- Each loan is split in multiple tranches.
- Each tranche has a different monthly interest percentage.
- Also each tranche has a maximum amount available to invest. So once the maximum is
reached, further investments can't be made in that tranche.
- As an investor, I can invest in a tranche at any time if the loan it’s still open, the maximum
available amount was not reached and I have enough money in my virtual wallet.
- At the end of the month we need to calculate the interest each investor is due to be paid. 

## Install
 
```shell
git clone https://github.com/giuly/LendInvest.git
cd LendInvest
```
Install php composer [here](https://getcomposer.org/download/)
```shell
php composer.phar install
```

## Test

PHPUnit Framework
```shell
./vendor/bin/phpunit tests --bootstrap vendor/autoload.php
```

