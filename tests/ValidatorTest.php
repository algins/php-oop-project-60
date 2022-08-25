<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class ValidatorTest extends TestCase
{
    public function testString(): void
    {
        $validator = new Validator();
        $schema1 = $validator->string();
        $schema2 = $validator->string();
        $schema3 = $validator->string()->required();
        $schema4 = $validator->string()->minLength(10);
        $schema5 = $validator->string()->contains('what');
        $schema6 = $validator->string()->minLength(10)->minLength(5);
        $schema7 = $validator->string()->contains('what')->contains('');

        $this->assertNotSame($schema1, $schema2);

        $this->assertTrue($schema1->isValid('what does the fox say'));
        $this->assertTrue($schema1->isValid(''));
        $this->assertTrue($schema1->isValid(null));

        $this->assertTrue($schema3->isValid('what does the fox say'));
        $this->assertFalse($schema3->isValid(''));
        $this->assertFalse($schema3->isValid(null));

        $this->assertTrue($schema4->isValid('what does the fox say'));
        $this->assertFalse($schema4->isValid('hexlet'));

        $this->assertTrue($schema5->isValid('what does the fox say'));
        $this->assertFalse($schema5->isValid('hexlet'));

        $this->assertTrue($schema6->isValid('hexlet'));

        $this->assertTrue($schema7->isValid('hexlet'));
    }
}
