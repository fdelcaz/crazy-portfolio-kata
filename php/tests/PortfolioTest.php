<?php

use FernandoDelCazBabon\Php\Portfolio;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Portfolio.php';

class PortfolioTest extends TestCase {
    public function testComputePortfolioValueHappyPath() {
        ob_start();

        $portfolio = new Portfolio("portfolio.csv");

        $portfolio->computePortfolioValue();

        $output = ob_get_clean();

        $expectedOutput = "Portfolio is priceless because it got a unicorn on 2024-01-15!!!!!\n";
        $this->assertEquals($expectedOutput, $output);
    }

    public function testComputePortfolioValueWithWrongDate() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('wrong date');

        $portfolio = new Portfolio("portfoliowithwrongdate.csv");
        $portfolio->computePortfolioValue();
    }
}

?>
