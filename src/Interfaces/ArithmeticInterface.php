<?php

namespace Danyseif\Calcify\Interfaces;

use Danyseif\Calcify\Constant\ArithmeticConstant as Constant;

/**
 * Interface ArithmeticInterface
 *
 * This interface defines the contract for arithmetic operations in the Calcify package.
 * It includes basic arithmetic, trigonometric, logarithmic, and percentage-based operations.
 */
interface ArithmeticInterface
{
    /**
     * Add a value to the current result.
     *
     * @param mixed $value The value to add.
     * @return self
     */
    public function add($value);

    /**
     * Subtract a value from the current result.
     *
     * @param mixed $value The value to subtract.
     * @return self
     */
    public function subtract($value);

    /**
     * Multiply the current result by a value.
     *
     * @param mixed $value The value to multiply by.
     * @return self
     */
    public function multiply($value);

    /**
     * Divide the current result by a value.
     *
     * @param mixed $value The value to divide by.
     * @return self
     */
    public function divide($value);

    /**
     * Calculate the modulo of the current result by a value.
     *
     * @param mixed $value The value to use for modulo operation.
     * @return self
     */
    public function modulo($value);

    /**
     * Raise the current result to the power of a value.
     *
     * @param mixed $value The exponent.
     * @return self
     */
    public function power($value);

    /**
     * Calculate the nth root of the current result.
     *
     * @param mixed $value The root value.
     * @return self
     */
    public function root($value);

    /**
     * Calculate the logarithm of the current result with a specified base.
     *
     * @param mixed $base The logarithm base.
     * @return self
     */
    public function logarithm($base);

    /**
     * Calculate the natural logarithm (base e) of the current result.
     *
     * @return self
     */
    public function naturalLogarithm();

    /**
     * Calculate the common logarithm (base 10) of the current result.
     *
     * @return self
     */
    public function commonLogarithm();

    /**
     * Calculate e raised to the power of the current result.
     *
     * @return self
     */
    public function exponential();

    /**
     * Calculate the sine of the current result.
     *
     * @return self
     */
    public function sine();

    /**
     * Calculate the cosine of the current result.
     *
     * @return self
     */
    public function cosine();

    /**
     * Calculate the tangent of the current result.
     *
     * @return self
     */
    public function tangent();

    /**
     * Calculate the cotangent of the current result.
     *
     * @return self
     */
    public function cotangent();

    /**
     * Calculate the secant of the current result.
     *
     * @return self
     */
    public function secant();

    /**
     * Calculate the cosecant of the current result.
     *
     * @return self
     */
    public function cosecant();

    /**
     * Calculate the arcsine (inverse sine) of the current result.
     *
     * @return self
     */
    public function arcsine();

    /**
     * Calculate the arccosine (inverse cosine) of the current result.
     *
     * @return self
     */
    public function arccosine();

    /**
     * Calculate the arctangent (inverse tangent) of the current result.
     *
     * @return self
     */
    public function arctangent();

    /**
     * Calculate the arccotangent (inverse cotangent) of the current result.
     *
     * @return self
     */
    public function arccotangent();

    /**
     * Calculate the arcsecant (inverse secant) of the current result.
     *
     * @return self
     */
    public function arcsecant();

    /**
     * Calculate the arccosecant (inverse cosecant) of the current result.
     *
     * @return self
     */
    public function arccosecant();

    /**
     * Calculate the hyperbolic sine of the current result.
     *
     * @return self
     */
    public function hyperbolicSine();

    /**
     * Calculate the hyperbolic cosine of the current result.
     *
     * @return self
     */
    public function hyperbolicCosine();

    /**
     * Calculate the hyperbolic tangent of the current result.
     *
     * @return self
     */
    public function hyperbolicTangent();

    /**
     * Calculate the hyperbolic cotangent of the current result.
     *
     * @return self
     */
    public function hyperbolicCotangent();

    /**
     * Calculate the hyperbolic secant of the current result.
     *
     * @return self
     */
    public function hyperbolicSecant();

    /**
     * Calculate the hyperbolic cosecant of the current result.
     *
     * @return self
     */
    public function hyperbolicCosecant();

    /**
     * Calculate the inverse hyperbolic sine of the current result.
     *
     * @return self
     */
    public function inverseHyperbolicSine();

    /**
     * Calculate the inverse hyperbolic cosine of the current result.
     *
     * @return self
     */
    public function inverseHyperbolicCosine();

    /**
     * Calculate the inverse hyperbolic tangent of the current result.
     *
     * @return self
     */
    public function inverseHyperbolicTangent();

    /**
     * Calculate the inverse hyperbolic cotangent of the current result.
     *
     * @return self
     */
    public function inverseHyperbolicCotangent();

    /**
     * Calculate the inverse hyperbolic secant of the current result.
     *
     * @return self
     */
    public function inverseHyperbolicSecant();

    /**
     * Calculate the inverse hyperbolic cosecant of the current result.
     *
     * @return self
     */
    public function inverseHyperbolicCosecant();

    /**
     * Calculate the factorial of the current result.
     *
     * @return self
     */
    public function factorial();

    /**
     * Calculate the absolute value of the current result.
     *
     * @return self
     */
    public function absolute();

    /**
     * Set the current result to the maximum of itself and the given value.
     *
     * @param mixed $value The value to compare with.
     * @return self
     */
    public function maximum($value);

    /**
     * Set the current result to the minimum of itself and the given value.
     *
     * @param mixed $value The value to compare with.
     * @return self
     */
    public function minimum($value);

    /**
     * Calculate the percentage of the current result.
     *
     * @param mixed $percent The percentage to calculate.
     * @return self
     */
    public function percentage($percent);

    /**
     * Add a percentage to the current result.
     *
     * @param mixed $percent The percentage to add.
     * @return self
     */
    public function addPercentage($percent);

    /**
     * Subtract a percentage from the current result.
     *
     * @param mixed $percent The percentage to subtract.
     * @return self
     */
    public function subtractPercentage($percent);

    /**
     * Apply a discount percentage to the current result.
     *
     * @param mixed $percent The discount percentage to apply.
     * @return self
     */
    public function discount($percent);

    /**
     * Increase the current result by a percentage.
     *
     * @param mixed $percent The percentage to increase by.
     * @return self
     */
    public function increaseByPercentage($percent);

    /**
     * Decrease the current result by a percentage.
     *
     * @param mixed $percent The percentage to decrease by.
     * @return self
     */
    public function decreaseByPercentage($percent);

    /**
     * Get the current result.
     *
     * @return mixed The current result.
     */
    public function getResult();

    /**
     * Get the formatted result according to the specified format.
     *
     * @param string $format The format to apply to the result.
     * @return string The formatted result.
     */
    public function getFormattedResult(string $format);

    /**
     * Reset the current result to the specified value or 0.
     *
     * @param mixed $value The value to reset to. Defaults to 0.
     * @return self
     */
    public function reset($value = 0);
}
