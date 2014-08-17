<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 12.4.14
 * Time: 21:56
 */

namespace ondrs\Otomoto\Struct;


class Advert extends BaseStruct
{
    public $Advertisement;
    public $Airbags;
    public $AllowedWeight;
    public $Axis;
    public $Category;
    public $ClientId;
    public $Color;
    public $Construction;
    public $Country;
    public $CubicCapacity;
    public $DateOfFirstReg;
    public $DateOfMade;
    public $DontUsePhotos;
    public $Doors;


    public $Euro;
    public $ExtendedDescription;
    public $FirstOwner;
    public $FuelType;
    public $Gearbox;
    public $Id;
    public $ImportProducerModelName;
    public $ImportProducerName;
    public $LeasingPrice;
    public $Length;
    public $MaxLoad;
    public $NotDamaged;
    public $OriginalId;
    public $Power;
    public $Price;
    public $PriceCurrency;
    public $Producer;
    public $ProducerModel;
    public $ProducerModelName;
    public $ProducerName;
    public $Region;
    public $RimBoltCircleDiameter;
    public $RimBoltCount;
    public $RimCenterBore;
    public $RimDiameter;
    public $RimET;
    public $RimWidth;
    public $Seats;
    public $ServiceBook;
    public $Speeds;
    public $StkValidTo;
    public $Tacho;
    public $TachoUnit;
    public $TyreAspectRation;
    public $TyreDOT;
    public $TyreLI;
    public $TyreRFT;
    public $TyreSI;
    public $TyreSeason;
    public $TyreSize;
    public $VAT;
    public $VIN;
    public $Weight;
    public $WheelDrive;

    /** @var AdvertPhoto[]  */
    public $Photos = [];

    /** @var int[] */
    public $Equipment = [];
} 
