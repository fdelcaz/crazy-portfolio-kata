<?php

use FernandoDelCazBabon\Php\Portfolio;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Portfolio.php';

class PortfolioTest extends TestCase {
    public function testComputePortfolioValue() {
        ob_start();

        $portfolio = new Portfolio("portfolio.csv");

        $portfolio->computePortfolioValue();

        $output = ob_get_clean();

        $expectedOutput = "Portfolio is priceless because it got a unicorn on 2024-01-15!!!!!\n";
        $this->assertEquals($expectedOutput, $output);
    }
}

?>
