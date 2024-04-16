<?php

namespace FernandoDelCazBabon\Php;
class Asset {
    private $_description;
    private $_date;
    private $_value;

    public function __construct($description, $date, $value) {
        $this->_description = $description;
        $this->_date = $date;
        $this->_value = $value;
    }

    public function getDescription() {
        return $this->_description;
    }

    public function getDate() {
        return $this->_date;
    }

    public function getValue() {
        return $this->_value;
    }

    public function setValue($value) {
        $this->_value = $value;
    }
}

abstract class Value {
    protected $_value;

    protected function __construct($value) {
        $this->_value = $value;
    }

    public function get() {
        return $this->_value;
    }

    public function toString() {
        return strval($this->_value);
    }
}

class MeasurableValue extends Value {
    public function __construct($value) {
        parent::__construct($value);
    }
}

class PricelessValue extends Value {
    public function __construct() {
        parent::__construct(INF);
    }
}

class NoValue extends Value {
    public function __construct() {
        parent::__construct(0);
    }
}

?>