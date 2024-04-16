<?php

namespace FernandoDelCazBabon\Php;

use DateTime;
use Exception;

require_once 'Asset.php';

class Portfolio {
    private $_portfolioCsvPath;

    public function __construct($portfolioCsvPath) {
        $this->_portfolioCsvPath = $portfolioCsvPath;
    }

    public function computePortfolioValue() {
        $now = new DateTime();
        $readText = file_get_contents($this->_portfolioCsvPath);
        $lines = explode("\n", $readText);
        $portfolioValue = new MeasurableValue(0);

        foreach ($lines as $line) {
            $columns = explode(",", $line);

            [$year, $month, $day] = explode("/", $columns[1]);
            if (in_array(null, [$year, $month, $day], true)) {
                throw new Exception("wrong date");
            }
            $date = new DateTime("$year-$month-$day");

            $asset = new Asset($columns[0], $date,
                $columns[0] === "Unicorn" ? new PricelessValue() : new MeasurableValue(floatval($columns[2])));

            $daysDifference = $now->diff($asset->getDate())->days;
            if ($daysDifference < 0) {
                if ($asset->getDescription() !== "French Wine") {
                    if ($asset->getDescription() !== "Lottery Prediction") {
                        if ($asset->getValue()->get() > 0) {
                            if ($asset->getDescription() !== "Unicorn") {
                                $asset->setValue(new MeasurableValue($asset->getValue()->get() - 20));
                            } else {
                                echo "Portfolio is priceless because it got a unicorn on " . $asset->getDate()->format("Y-m-d") . "!!!!!\n";
                                return;
                            }
                        }
                    } else {
                        $asset->setValue(new MeasurableValue($asset->getValue()->get() - $asset->getValue()->get()));
                    }
                } else {
                    if ($asset->getValue()->get() < 200) {
                        $asset->setValue(new MeasurableValue($asset->getValue()->get() + 20));
                    }
                }
            } else {
                if ($asset->getDescription() !== "French Wine" && $asset->getDescription() !== "Lottery Prediction") {
                    if ($asset->getValue()->get() > 0.0) {
                        if ($asset->getDescription() !== "Unicorn") {
                            $asset->setValue(new MeasurableValue($asset->getValue()->get() - 10));
                        } else {
                            echo "Portfolio is priceless because it got a unicorn on " . $asset->getDate()->format("Y-m-d") . "!!!!!\n";
                            return;
                        }
                    } else {
                        if ($asset->getDescription() === "Unicorn") {
                            echo "Portfolio is priceless because it got a unicorn on " . $asset->getDate()->format("Y-m-d") . "!!!!!\n";
                            return;
                        }
                    }
                } else {
                    if ($asset->getDescription() === "Lottery Prediction") {
                        if ($asset->getValue()->get() < 800) {
                            $asset->setValue(new MeasurableValue($asset->getValue()->get() + 5));

                            if ($daysDifference < 11) {
                                if ($asset->getValue()->get() < 800) {
                                    $asset->setValue(new MeasurableValue($asset->getValue()->get() + 20));
                                }
                            }

                            if ($daysDifference < 6) {
                                if ($asset->getValue()->get() < 800) {
                                    $asset->setValue(new MeasurableValue($asset->getValue()->get() + 100));
                                }
                            }
                        }
                    } else {
                        if ($asset->getValue()->get() < 200) {
                            $asset->setValue(new MeasurableValue($asset->getValue()->get() + 10));
                        }
                    }
                }
            }
            $portfolioValue = new MeasurableValue($portfolioValue->get() + $asset->getValue()->get());
        }
        echo $portfolioValue->get() . "\n";
    }
}

?>
