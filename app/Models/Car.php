<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $dateFormat = 'Y-m-d H:i:s';

    protected $casts = [
        'build_date' => 'datetime'
    ];
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    /**
     * @return string
     */
    public function getMake(): string
    {
        return $this->getAttribute('make');
    }

    /**
     * @param string $make
     * @return Car
     */
    public function setMake(string $make): Car
    {
        $this->setAttribute('make', $make);
        return $this;
    }

    /**
     * @param string $model
     * @return Car
     */
    public function setModelName(string $model): Car
    {
        $this->setAttribute('model', $model);
        return $this;
    }

    /**
     * @return string
     */
    public function getModelName(): string
    {
        return $this->getAttribute('model');
    }

    /**
     * @return DateTime
     */
    public function getBuildDate(): DateTime
    {
        return $this->getAttribute('build_date');
    }

    /**
     * @param DateTime $buildDate
     * @return Car
     */
    public function setBuildDate(DateTime $buildDate): Car
    {
        $this->setAttribute('build_date', $buildDate);
        return $this;
    }

    /**
     * @return Colour
     */
    public function getColour(): Colour
    {
        return $this->getAttribute('colour');
    }

    /**
     * @param Colour $colour
     * @return Car
     */
    public function setColour(Colour $colour): Car
    {
        $this->colour()->associate($colour);
        return $this;
    }

    /**
     * @return BelongsTo
     */
    public function colour()
    {
        return $this->belongsTo(Colour::class);
    }
}