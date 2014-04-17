<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 12.4.14
 * Time: 21:56
 */

namespace ondrs\Otomoto\Struct;


use ondrs\Otomoto\BaseStruct;

class AdvertStatus extends BaseStruct
{
    const
        STATUS_ACTIVE = 3,
        STATUS_INACTIVE = 2;

    public $Id;
    public $Status;
} 
