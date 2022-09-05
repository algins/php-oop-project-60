<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class ValidatorTest extends TestCase
{
    private Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testString(): void
    {
        $schema1 = $this->validator->string();
        $schema2 = $this->validator->string();
        $this->assertNotSame($schema1, $schema2);
        $this->assertTrue($schema2->isValid('what does the fox say'));
        $this->assertTrue($schema2->isValid(''));
        $this->assertTrue($schema2->isValid(null));

        $schema3 = $this->validator->string()->required();
        $this->assertTrue($schema3->isValid('what does the fox say'));
        $this->assertFalse($schema3->isValid(''));
        $this->assertFalse($schema3->isValid(null));

        $schema4 = $this->validator->string()->minLength(10);
        $this->assertTrue($schema4->isValid('what does the fox say'));
        $this->assertFalse($schema4->isValid('hexlet'));

        $schema5 = $this->validator->string()->minLength(10)->minLength(5);
        $this->assertTrue($schema5->isValid('hexlet'));

        $schema6 = $this->validator->string()->contains('what');
        $this->assertTrue($schema6->isValid('what does the fox say'));
        $this->assertFalse($schema6->isValid('hexlet'));

        $schema7 = $this->validator->string()->contains('what')->contains('');
        $this->assertTrue($schema7->isValid('hexlet'));
    }

    public function testNumber(): void
    {
        $schema1 = $this->validator->number();
        $schema2 = $this->validator->number();
        $this->assertNotSame($schema1, $schema2);
        $this->assertTrue($schema2->isValid(7));
        $this->assertTrue($schema2->isValid(null));

        $schema3 = $this->validator->number()->required();
        $this->assertTrue($schema3->isValid(7));
        $this->assertFalse($schema3->isValid(null));

        $schema4 = $this->validator->number()->positive();
        $this->assertTrue($schema4->isValid(10));
        $this->assertFalse($schema4->isValid(-3));

        $schema5 = $this->validator->number()->range(-5, 5);
        $this->assertTrue($schema5->isValid(5));
        $this->assertTrue($schema5->isValid(-5));
        $this->assertFalse($schema5->isValid(10));

        $schema6 = $this->validator->number()->range(-5, 5)->range(-5, 10);
        $this->assertTrue($schema6->isValid(10));
    }

    public function testArray(): void
    {
        $schema1 = $this->validator->array();
        $schema2 = $this->validator->array();
        $this->assertNotSame($schema1, $schema2);
        $this->assertTrue($schema2->isValid(['hexlet']));
        $this->assertTrue($schema2->isValid([]));
        $this->assertTrue($schema2->isValid(null));

        $schema3 = $this->validator->array()->required();
        $this->assertTrue($schema3->isValid(['hexlet']));
        $this->assertTrue($schema3->isValid([]));
        $this->assertFalse($schema3->isValid(null));

        $schema4 = $this->validator->array()->sizeof(2);
        $this->assertTrue($schema4->isValid(['hexlet', 'code-basics']));
        $this->assertFalse($schema4->isValid(['hexlet']));

        $schema5 = $this->validator->array()->sizeof(2)->sizeof(1);
        $this->assertTrue($schema5->isValid(['hexlet']));

        $schema6 = $this->validator->array()->shape([
            'name' => $this->validator->string()->required(),
            'age' => $this->validator->number()->positive(),
        ]);

        $this->assertTrue($schema6->isValid(['name' => 'joe', 'age' => 100]));
        $this->assertFalse($schema6->isValid(['name' => '', 'age' => 100]));
        $this->assertFalse($schema6->isValid(['name' => 'joe', 'age' => -5]));
    }
}
