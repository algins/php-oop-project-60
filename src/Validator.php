<?php

namespace Hexlet\Validator;

use Hexlet\Validator\Schemas\StringSchema;

class Validator
{
    public function string(): StringSchema
    {
        return new StringSchema();
    }
}
