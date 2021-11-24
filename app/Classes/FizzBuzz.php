<?php
    namespace App\Classes;
    use InvalidArgumentException;

    class FizzBuzz
    {

        protected $stringToNumberRelationship = ['Fizz' => 3, 'Buzz' => 5];

        private function make_sure_array_is_all_numbers(array $array = [], string $message = 'Invalid argument')
        {
            if (!$this->array_has_only_ints($array)) {
                throw new InvalidArgumentException($message);
            }
        }

        public function run(array $array = [])
        {
            $this->make_sure_array_is_all_numbers($array, 'The FizzBuzz run method requires an array of integers.');
            
            foreach ($array as $num) {
                $fizzBuzzArray[] = $this->run_fizz_buzz($num);
            }

            return $fizzBuzzArray;
        }

        public function run_fizz_buzz(int $num = 0)
        {
            $value = NULL;

            foreach ($this->stringToNumberRelationship as $string => $numMultipleOf) {
                if ($num % $numMultipleOf == 0 && $num != 0) {
                    $value .= $string;
                }
            }

            return $value ?? $num;
        }

        public function set_string_num_pair(array $stringNumArray)
        {
            if(array_keys($stringNumArray) === range(0, count($stringNumArray) - 1)) {
                throw new InvalidArgumentException('The method set_string_num_pair requires an associative array!'); 
            }
            $this->make_sure_array_is_all_numbers($stringNumArray, 'The method set_string_num_pair requires an array of integers.');

            $this->stringToNumberRelationship = $stringNumArray;
        }

        // @ helper functions 
            protected function array_has_only_ints(array $array)
            {
                $testValue = implode('', $array);
                if (is_numeric($testValue)) {
                    // make value a number without altering it
                    $testValue = $testValue + 0;
                }
                
                return is_int($testValue);
            }
    }
?>