<?php

use FernandoDelCazBabon\Php\Portfolio;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Portfolio.php';

class PortfolioTest extends TestCase {
    public function testComputePortfolioValue() {
        $portfolio = new Portfolio("portfolio.csv");

        var_dump($portfolio);

        $this->expectNotToPerformAssertions();
        $portfolio->computePortfolioValue();
    }
}

?>
