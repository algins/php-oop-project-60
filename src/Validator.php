<?php

namespace Hexlet\Validator;

use Hexlet\Validator\Schemas\NumberSchema;
use Hexlet\Validator\Schemas\StringSchema;

class Validator
{
    public function string(): StringSchema
    {
        return new StringSchema();
    }

    public function number(): NumberSchema
    {
        return new NumberSchema();
    }
}
