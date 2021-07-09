<?php

class Patient extends \Phalcon\Mvc\Model
{

    public $patient_id;
    public $patient_name;
    public $patient_sex;
    public $patient_religion;
    public $patient_phone;
    public $patient_address;
    public $patient_nik;
    public $patient_created_at;
    public $patient_update_at;
    public function initialize()
    {
        $this->setSchema("hospital");
        $this->setSource("patient");
    }

    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }
}
