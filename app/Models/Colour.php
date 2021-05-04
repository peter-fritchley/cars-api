<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colour extends Model
{
    public $timestamps = false;

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
    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    /**
     * @param string $name
     * @return Colour
     */
    public function setName(string $name): Colour
    {
        $this->setAttribute('name', $name);
        return $this;
    }
}