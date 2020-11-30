<?php

class ShippingYard
{
    const SAIL_BOAT   = 'perahu layar';
    const MOTOR_BOAT  = 'perahu motor';
    const CRUISE_SHIP = 'kapal pesiar';

    protected $status_success = 'success';
    protected $status_error   = 'error';

    private $results;

    /**
     * ShippingYard constructor.
     */
    public function __construct()
    {
        $this->results = new stdClass();
        $this->results->status = $this->status_error;
        $this->results->data = new stdClass();
    }

    public function store(string $type, array $data)
    {
        $func = self::getFuncInsertByType($type);

        if (empty($func)) {
            return $this->results;
        }

        $store_data = $this->{$func}($data);

        echo json_encode($store_data);
    }

    private function getFuncInsertByType($type): string
    {
        if ($type == self::SAIL_BOAT) {
            return "insertSailBoat";
        }

        if ($type == self::MOTOR_BOAT) {
            return "insertMotorBoat";
        }

        if ($type == self::CRUISE_SHIP) {
            return "insertCruiseShip";
        }

        return '';
    }

    private function insertSailBoat($data): stdClass
    {
        $result = $this->results;
        $result->status = $this->status_success;
        $result->data->type = self::SAIL_BOAT;
        $result->data->data = $data;

        return $result;
    }

    private function insertMotorBoat($data): stdClass
    {
        $result = $this->results;
        $result->status = $this->status_success;
        $result->data->type = self::MOTOR_BOAT;
        $result->data->data = $data;

        return $result;
    }

    private function insertCruiseShip($data): stdClass
    {
        $result = $this->results;
        $result->status = $this->status_success;
        $result->data->type = self::CRUISE_SHIP;
        $result->data->data = $data;

        return $result;
    }
}

$shipping = new ShippingYard();
$shipping->store($shipping::MOTOR_BOAT, ['name' => 'Test Store Motor Boat']);
$shipping->store($shipping::MOTOR_BOAT, ['name' => 'Test Store Motor Boat']);