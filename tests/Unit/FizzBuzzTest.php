<?php

namespace Tests\Unit;

use App\Classes\FizzBuzz;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

// Make it fail. Make it work. Make it right. Make it fast.

class FizzBuzzTest extends TestCase
{

    // * Write a class that accepts an array of numbers and modifies the array as shown below
    // * For multiples of three returns "Fizz" instead of the number
    // * For the multiples of five returns "Buzz"
    // * For numbers which are multiples of both three and five return "FizzBuzz".
    // * Ensure that only an array of integers can be passed as an argument to the class.
    // Make the program dynamic. Allow the client to input the string and a number multiple for the replacement. Example: For multiples of 2 return "Foo"
    // Make the dynamic program more dynamic. Allow the client to determine what to print for multiple number multiples criteria. Example: For multiples of both 4 and 6 print "Bar"
    
    public function testFizzBuzzWith3And5And15And22Test()
    {
        // Given
        $FizzBuzz = new FizzBuzz();

        // When 
        $when3 = $FizzBuzz->run_fizz_buzz(3);
        $when5 = $FizzBuzz->run_fizz_buzz(5);
        $when15 = $FizzBuzz->run_fizz_buzz(15);
        $when22 = $FizzBuzz->run_fizz_buzz(22);
        
        // Then
        $this->assertTrue('Fizz' == $when3);
        $this->assertTrue('Buzz' == $when5);
        $this->assertTrue('FizzBuzz' == $when15);
        $this->assertTrue(22 == $when22);
    }

    public function testFizzBuzzWithAnArrayThatIsNotIntegersIsString()
    {
        // Given
        $FizzBuzz = new FizzBuzz();

        // Then
        $this->expectException(InvalidArgumentException::class);
       
        // When 
        $whenArray = $FizzBuzz->run(['jim', 88, 'gogo']);
    }

    public function testFizzBuzzWithAnArrayThatIsNotIntegersIsFloat()
    {
        // Given
        $FizzBuzz = new FizzBuzz();

        // Then
        $this->expectException(InvalidArgumentException::class);
       
        // When 
        $whenArray = $FizzBuzz->run([22, 88, 22.3]);
    }

    public function testFizzBuzzWithAnArray3And5And15And22()
    {
        // Given
        $FizzBuzz = new FizzBuzz();

        // When 
        $whenArray = $FizzBuzz->run([3,5,15,22]);
        
        // Then
        $this->assertTrue(['Fizz', 'Buzz', 'FizzBuzz', 22] == $whenArray);
    }

    // Make it fail. Make it work. Make it right. Make it fast.
    public function testFizzBuzzWithDynamicStringMultipleOfNumberRelationship()
    {
        // Given
        $FizzBuzz = new FizzBuzz();
        $FizzBuzz->set_string_num_pair(['Foo' => 3, 'Bar' => 5, 'Nice' => 2]);

        // When 
        $whenArray = $FizzBuzz->run([3,5,15,20,22,30]);

        // Then
        $this->assertTrue(['Foo', 'Bar', 'FooBar', 'BarNice', 'Nice', 'FooBarNice'] == $whenArray);
    }

    public function testFizzBuzzWithDynamicStringMultipleOfNumberRelationshipNotAssociativeArray()
    {
        // Given
        $FizzBuzz = new FizzBuzz();

        // Then
        $this->expectException(InvalidArgumentException::class);
       
        // When 
        $FizzBuzz->set_string_num_pair([3,5,15,20,22,30]);
    }

    public function testFizzBuzzWithDynamicStringMultipleOfNumberRelationshipAssociativeArrayNotNumbers()
    {
        // Given
        $FizzBuzz = new FizzBuzz();

        // Then
        $this->expectException(InvalidArgumentException::class);
       
        // When 
        $FizzBuzz->set_string_num_pair(['Foo' => 3, 'Bar' => 'sam', 'Nice' => 2]);
    }
    
}
