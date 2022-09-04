<?php

namespace Hexlet\Validator\Schemas;

class NumberSchema
{
    private array $rules = [];

    public function isValid(?int $value): bool
    {
        foreach ($this->rules as $rule) {
            if (!$rule($value)) {
                return false;
            }
        }

        return true;
    }

    public function required(): self
    {
        $this->rules['required'] = fn ($value) => $value !== null;

        return $this;
    }

    public function positive(): self
    {
        $this->rules['positive'] = fn ($value) => $value > 0;

        return $this;
    }

    public function range(int $min, int $max): self
    {
        $this->rules['range'] = fn ($value) => ($min <= $value) && ($value <= $max);

        return $this;
    }
}
