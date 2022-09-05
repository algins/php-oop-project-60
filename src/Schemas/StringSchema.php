<?php

namespace Hexlet\Validator\Schemas;

class StringSchema
{
    private array $rules = [];

    public function isValid(?string $value): bool
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
        $this->rules['required'] = fn($value) => !empty($value);

        return $this;
    }

    public function minLength(int $minLength): self
    {
        $this->rules['minLength'] = fn($value) => mb_strlen($value) >= $minLength;

        return $this;
    }

    public function contains(string $subString): self
    {
        $this->rules['contains'] = fn($value) => str_contains($value, $subString);

        return $this;
    }
}
