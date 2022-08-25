<?php

namespace Hexlet\Validator\Schemas;

class StringSchema
{
    private bool $required = false;
    private int $minLength = 0;
    private string $contains = '';

    public function isValid(?string $nullableString): bool
    {
        $string = $nullableString ?? '';

        if (!$string && $this->required) {
            return false;
        }

        if (mb_strlen($string) < $this->minLength) {
            return false;
        }

        if (!str_contains($string, $this->contains)) {
            return false;
        }

        return true;
    }

    public function required(): self
    {
        $this->required = true;

        return $this;
    }

    public function minLength(int $minLength): self
    {
        $this->minLength = $minLength;

        return $this;
    }

    public function contains(string $contains): self
    {
        $this->contains = $contains;

        return $this;
    }
}
