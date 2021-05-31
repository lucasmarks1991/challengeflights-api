<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Jenssegers\Model\Model;

class Flight extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'cia',
        'fare',
        'flightNumber',
        'origin',
        'destination',
        'departureDate',
        'arrivalDate',
        'departureTime',
        'arrivalTime',
        'classService',
        'price',
        'tax',
        'outbound',
        'inbound',
        'duration',
    ];

    /*
    public function getDepartureAttribute($value)
    {
        return DateTime::createFromFormat('d/m/Y H:i', $this->departureDate . ' ' . $this->departureTime, new DateTimeZone('America/Sao_Paulo'));
    }

    public function getArrivalAttribute($value)
    {
        return DateTime::createFromFormat('d/m/Y H:i', $this->arrivalDate . ' ' . $this->arrivalTime, new DateTimeZone('America/Sao_Paulo'));
    }
    */

    public function getBoundAttribute($value)
    {
        return $this->outbound ? 'out' : 'in';
    }
}
