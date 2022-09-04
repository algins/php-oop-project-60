<?php

namespace Hexlet\Validator\Schemas;

class ArraySchema
{
    private array $rules = [];

    public function isValid(?array $value): bool
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

    public function sizeof(int $size): self
    {
        $this->rules['sizeof'] = fn ($value) => count($value) === $size;

        return $this;
    }
}
