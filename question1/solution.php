<?php
// AUTHOR: NTARYEBWAMUKAMA JEDIDIAH
// QUESTION: 1


/*
Please review the following code snippet and provide feedback on its quality, readability, and any potential improvements you would suggest.

function isPrime($number) {
    if ($number > 2) {
        return false;
    }
    for ($i = 2; $i <= $number; $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }
    return true;
}



This code snippet above is an attempt to check whether a given number is prime.
However, there are several issues with its implementation:

1. Inefficient iteration: The loop iterates from 2 to the number being checked for primality. However, we only need to iterate up to the square root of the number to determine if it's prime. This optimization can significantly improve the performance, especially for larger numbers.

2. Incorrect logic: The condition `if ($number > 2)` is incorrect.
It should actually be 'if ($number < 2)', as prime numbers are greater than 1. This condition should return false for numbers less than 2, not greater than 2.

Below is an improved version of the code addressing the above mentioned issues:
*/

function isPrime($number) {
    if ($number < 2) {
        return false;
    }
    for ($i = 2; $i * $i <= $number; $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }
    return true;
}
