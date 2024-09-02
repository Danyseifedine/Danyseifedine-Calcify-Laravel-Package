<?php

namespace Danyseif\Calcify\Base;

use Danyseif\Calcify\Constant as C;
use Danyseif\Calcify\Errors\DivisionByZeroException;
use Danyseif\Calcify\Errors\InvalidNumberException;
use Danyseif\Calcify\Errors\InvalidRoundingModeException;
use Danyseif\Calcify\Interfaces\ArithmeticInterface;
use InvalidArgumentException;

/**
 * Class Arithmetic
 *
 * This class provides various arithmetic operations including addition, subtraction,
 * multiplication, division, modulo, power, root, logarithms, trigonometric functions,
 * hyperbolic functions, factorial, absolute value, and percentage calculations.
 *
 * Available methods:
 * - `__construct(float $initialValue, bool $isRounded, string $roundingMode, int $decimalPlaces)`
 * - `create(float $initialValue, bool $isRounded, string $roundingMode, int $decimalPlaces): self`
 * - `enableRounding(string $roundingMode): self`
 * - `disableRounding(int $decimalPlaces): self`
 * - `add($value): self`
 * - `subtract($value): self`
 * - `multiply($value): self`
 * - `divide($value): self`
 * - `modulo($value): self`
 * - `power($value): self`
 * - `root($value): self`
 * - `logarithm($base): self`
 * - `naturalLogarithm(): self`
 * - `commonLogarithm(): self`
 * - `exponential(): self`
 * - `sine(): self`
 * - `cosine(): self`
 * - `tangent(): self`
 * - `cotangent(): self`
 * - `secant(): self`
 * - `cosecant(): self`
 * - `arcsine(): self`
 * - `arccosine(): self`
 * - `arctangent(): self`
 * - `arccotangent(): self`
 * - `arcsecant(): self`
 * - `arccosecant(): self`
 * - `hyperbolicSine(): self`
 * - `hyperbolicCosine(): self`
 * - `hyperbolicTangent(): self`
 * - `hyperbolicCotangent(): self`
 * - `hyperbolicSecant(): self`
 * - `hyperbolicCosecant(): self`
 * - `inverseHyperbolicSine(): self`
 * - `inverseHyperbolicCosine(): self`
 * - `inverseHyperbolicTangent(): self`
 * - `inverseHyperbolicCotangent(): self`
 * - `inverseHyperbolicSecant(): self`
 * - `inverseHyperbolicCosecant(): self`
 * - `factorial(): self`
 * - `absolute(): self`
 * - `maximum($value): self`
 * - `minimum($value): self`
 * - `percentage($percent): self`
 * - `addPercentage($percent): self`
 * - `subtractPercentage($percent): self`
 * - `discount($percent): self`
 * - `increaseByPercentage($percent): self`
 * - `decreaseByPercentage($percent): self`
 * - `getResult(): float`
 * - `reset($value): self`
 * - `__toString(): string`
 * - `getFormattedResult(string $format): string|int`
 * - `__invoke(): float`
 */
class Arithmetic implements ArithmeticInterface
{
    /**
     * @var float The result of arithmetic operations.
     */
    private float $result;

    /**
     * @var bool Indicates if rounding is enabled.
     */
    private bool $isRounded;

    /**
     * @var string The rounding mode to be used.
     */
    private string $roundingMode;

    /**
     * @var int The number of decimal places to round to.
     */
    private int $decimalPlaces;

    /**
     * Arithmetic constructor.
     *
     * @param float $initialValue The initial value for arithmetic operations.
     * @param bool $isRounded Indicates if rounding is enabled.
     * @param string $roundingMode The rounding mode to be used.
     * @param int $decimalPlaces The number of decimal places to round to.
     */
    public function __construct(
        float $initialValue = C::DEFAULT_INITIAL_VALUE,
        bool $isRounded = C::DEFAULT_ROUNDED,
        string $roundingMode = C::DEFAULT_ROUNDING_MODE,
        int $decimalPlaces = C::DEFAULT_DECIMAL_PLACES
    ) {
        $this->result = $this->convertToNumber($initialValue);
        $this->isRounded = $isRounded;
        $this->roundingMode = $roundingMode;
        $this->decimalPlaces = $decimalPlaces;
    }

    /**
     * Create a new instance of Arithmetic.
     *
     * @param float $initialValue The initial value for arithmetic operations.
     * @param bool $isRounded Indicates if rounding is enabled.
     * @param string $roundingMode The rounding mode to be used.
     * @param int $decimalPlaces The number of decimal places to round to.
     * @return self
     */
    public static function create(
        float $initialValue = C::DEFAULT_INITIAL_VALUE,
        bool $isRounded = C::DEFAULT_ROUNDED,
        string $roundingMode = C::DEFAULT_ROUNDING_MODE,
        int $decimalPlaces = C::DEFAULT_DECIMAL_PLACES
    ): self {
        return new self($initialValue, $isRounded, $roundingMode, $decimalPlaces);
    }

    /**
     * Convert a value to a number.
     *
     * @param mixed $value The value to convert.
     * @return float The converted number.
     * @throws InvalidNumberException If the value is not a number or numeric string.
     */
    private function convertToNumber($value): float
    {
        if (is_numeric($value)) {
            return (float)$value;
        }
        throw new InvalidNumberException("Value must be a number or numeric string");
    }

    /**
     * Apply rounding to a value.
     *
     * @param float $value The value to round.
     * @return float The rounded value.
     * @throws InvalidRoundingModeException If the rounding mode is invalid.
     */
    private function applyRounding(float $value): float
    {
        if ($this->isRounded) {
            switch ($this->roundingMode) {
                case C::ROUNDING_CEIL:
                    return ceil($value);
                case C::ROUNDING_FLOOR:
                    return floor($value);
                case C::ROUNDING_ROUND:
                    return round($value);
                default:
                    throw new InvalidRoundingModeException("Invalid rounding mode: {$this->roundingMode}");
            }
        }
        return round($value, $this->decimalPlaces);
    }

    /**
     * Enable rounding with a specified rounding mode.
     *
     * @param string $roundingMode The rounding mode to be used.
     * @return self
     * @throws InvalidRoundingModeException If the rounding mode is invalid.
     */
    public function enableRounding(string $roundingMode): self
    {
        if (!in_array($roundingMode, [C::ROUNDING_CEIL, C::ROUNDING_FLOOR, C::ROUNDING_ROUND])) {
            throw new InvalidRoundingModeException("Invalid rounding mode: {$roundingMode}");
        }
        $this->isRounded = true;
        $this->roundingMode = $roundingMode;
        return $this;
    }

    /**
     * Disable rounding and set the number of decimal places.
     *
     * @param int $decimalPlaces The number of decimal places to round to.
     * @return self
     * @throws InvalidArgumentException If the number of decimal places is negative.
     */
    public function disableRounding(int $decimalPlaces): self
    {
        if ($decimalPlaces < 0) {
            throw new InvalidArgumentException("Number of decimal places must be a non-negative integer.");
        }
        $this->isRounded = false;
        $this->decimalPlaces = $decimalPlaces;
        return $this;
    }

    /**
     * Add a value to the result.
     *
     * @param mixed $value The value to add.
     * @return self
     * @throws InvalidNumberException If the value is not a number or numeric string.
     */
    public function add($value): self
    {
        $this->result += $this->convertToNumber($value);
        return $this;
    }

    /**
     * Subtract a value from the result.
     *
     * @param mixed $value The value to subtract.
     * @return self
     * @throws InvalidNumberException If the value is not a number or numeric string.
     */
    public function subtract($value): self
    {
        $this->result -= $this->convertToNumber($value);
        return $this;
    }

    /**
     * Multiply the result by a value.
     *
     * @param mixed $value The value to multiply by.
     * @return self
     * @throws InvalidNumberException If the value is not a number or numeric string.
     */
    public function multiply($value): self
    {
        $this->result *= $this->convertToNumber($value);
        return $this;
    }

    /**
     * Divide the result by a value.
     *
     * @param mixed $value The value to divide by.
     * @return self
     * @throws InvalidNumberException If the value is not a number or numeric string.
     * @throws DivisionByZeroException If the value is zero.
     */
    public function divide($value): self
    {
        $value = $this->convertToNumber($value);
        if ($value == 0) {
            throw new DivisionByZeroException();
        }
        $this->result /= $value;
        return $this;
    }

    /**
     * Calculate the modulo of the result by a value.
     *
     * @param mixed $value The value to calculate the modulo with.
     * @return self
     * @throws InvalidNumberException If the value is not a number or numeric string.
     */
    public function modulo($value): self
    {
        $this->result %= $this->convertToNumber($value);
        return $this;
    }

    /**
     * Raise the result to the power of a value.
     *
     * @param mixed $value The value to raise the result to.
     * @return self
     * @throws InvalidNumberException If the value is not a number or numeric string.
     */
    public function power($value): self
    {
        $this->result **= $this->convertToNumber($value);
        return $this;
    }

    /**
     * Calculate the root of the result by a value.
     *
     * @param mixed $value The value to calculate the root with.
     * @return self
     * @throws InvalidNumberException If the value is not a number or numeric string.
     */
    public function root($value): self
    {
        $this->result **= (1 / $this->convertToNumber($value));
        return $this;
    }

    /**
     * Calculate the logarithm of the result with a specified base.
     *
     * @param mixed $base The base of the logarithm.
     * @return self
     * @throws InvalidNumberException If the base is not a number or numeric string.
     */
    public function logarithm($base): self
    {
        $this->result = log($this->result, $this->convertToNumber($base));
        return $this;
    }

    /**
     * Calculate the natural logarithm of the result.
     *
     * @return self
     */
    public function naturalLogarithm(): self
    {
        $this->result = log($this->result);
        return $this;
    }

    /**
     * Calculate the common logarithm (base 10) of the result.
     *
     * @return self
     */
    public function commonLogarithm(): self
    {
        $this->result = log10($this->result);
        return $this;
    }

    /**
     * Calculate the exponential of the result.
     *
     * @return self
     */
    public function exponential(): self
    {
        $this->result = exp($this->result);
        return $this;
    }

    /**
     * Calculate the sine of the result.
     *
     * @return self
     */
    public function sine(): self
    {
        $this->result = sin($this->result);
        return $this;
    }

    /**
     * Calculate the cosine of the result.
     *
     * @return self
     */
    public function cosine(): self
    {
        $this->result = cos($this->result);
        return $this;
    }

    /**
     * Calculate the tangent of the result.
     *
     * @return self
     */
    public function tangent(): self
    {
        $this->result = tan($this->result);
        return $this;
    }

    /**
     * Calculate the cotangent of the result.
     *
     * @return self
     */
    public function cotangent(): self
    {
        $this->result = 1 / tan($this->result);
        return $this;
    }

    /**
     * Calculate the secant of the result.
     *
     * @return self
     */
    public function secant(): self
    {
        $this->result = 1 / cos($this->result);
        return $this;
    }

    /**
     * Calculate the cosecant of the result.
     *
     * @return self
     */
    public function cosecant(): self
    {
        $this->result = 1 / sin($this->result);
        return $this;
    }

    /**
     * Calculate the arcsine of the result.
     *
     * @return self
     */
    public function arcsine(): self
    {
        $this->result = asin($this->result);
        return $this;
    }

    /**
     * Calculate the arccosine of the result.
     *
     * @return self
     */
    public function arccosine(): self
    {
        $this->result = acos($this->result);
        return $this;
    }

    /**
     * Calculate the arctangent of the result.
     *
     * @return self
     */
    public function arctangent(): self
    {
        $this->result = atan($this->result);
        return $this;
    }

    /**
     * Calculate the arccotangent of the result.
     *
     * @return self
     */
    public function arccotangent(): self
    {
        $this->result = M_PI / 2 - atan($this->result);
        return $this;
    }

    /**
     * Calculate the arcsecant of the result.
     *
     * @return self
     */
    public function arcsecant(): self
    {
        $this->result = acos(1 / $this->result);
        return $this;
    }

    /**
     * Calculate the arccosecant of the result.
     *
     * @return self
     */
    public function arccosecant(): self
    {
        $this->result = asin(1 / $this->result);
        return $this;
    }

    /**
     * Calculate the hyperbolic sine of the result.
     *
     * @return self
     */
    public function hyperbolicSine(): self
    {
        $this->result = sinh($this->result);
        return $this;
    }

    /**
     * Calculate the hyperbolic cosine of the result.
     *
     * @return self
     */
    public function hyperbolicCosine(): self
    {
        $this->result = cosh($this->result);
        return $this;
    }

    /**
     * Calculate the hyperbolic tangent of the result.
     *
     * @return self
     */
    public function hyperbolicTangent(): self
    {
        $this->result = tanh($this->result);
        return $this;
    }

    /**
     * Calculate the hyperbolic cotangent of the result.
     *
     * @return self
     */
    public function hyperbolicCotangent(): self
    {
        $this->result = 1 / tanh($this->result);
        return $this;
    }

    /**
     * Calculate the hyperbolic secant of the result.
     *
     * @return self
     */
    public function hyperbolicSecant(): self
    {
        $this->result = 1 / cosh($this->result);
        return $this;
    }

    /**
     * Calculate the hyperbolic cosecant of the result.
     *
     * @return self
     */
    public function hyperbolicCosecant(): self
    {
        $this->result = 1 / sinh($this->result);
        return $this;
    }

    /**
     * Calculate the inverse hyperbolic sine of the result.
     *
     * @return self
     */
    public function inverseHyperbolicSine(): self
    {
        $this->result = asinh($this->result);
        return $this;
    }

    /**
     * Calculate the inverse hyperbolic cosine of the result.
     *
     * @return self
     */
    public function inverseHyperbolicCosine(): self
    {
        $this->result = acosh($this->result);
        return $this;
    }

    /**
     * Calculate the inverse hyperbolic tangent of the result.
     *
     * @return self
     */
    public function inverseHyperbolicTangent(): self
    {
        $this->result = atanh($this->result);
        return $this;
    }

    /**
     * Calculate the inverse hyperbolic cotangent of the result.
     *
     * @return self
     */
    public function inverseHyperbolicCotangent(): self
    {
        $this->result = atanh(1 / $this->result);
        return $this;
    }

    /**
     * Calculate the inverse hyperbolic secant of the result.
     *
     * @return self
     */
    public function inverseHyperbolicSecant(): self
    {
        $this->result = acosh(1 / $this->result);
        return $this;
    }

    /**
     * Calculate the inverse hyperbolic cosecant of the result.
     *
     * @return self
     */
    public function inverseHyperbolicCosecant(): self
    {
        $this->result = asinh(1 / $this->result);
        return $this;
    }

    /**
     * Calculate the factorial of the result.
     *
     * @return self
     * @throws InvalidArgumentException If the result is a negative number.
     */
    public function factorial(): self
    {
        if ($this->result < 0) {
            throw new InvalidArgumentException("Factorial is not defined for negative numbers");
        }
        $this->result = array_product(range(1, (int)$this->result)) ?: 1;
        return $this;
    }

    /**
     * Calculate the absolute value of the result.
     *
     * @return self
     */
    public function absolute(): self
    {
        $this->result = abs($this->result);
        return $this;
    }

    /**
     * Calculate the maximum value between the result and a given value.
     *
     * @param mixed $value The value to compare with.
     * @return self
     */
    public function maximum($value): self
    {
        $this->result = max($this->result, $this->convertToNumber($value));
        return $this;
    }

    /**
     * Calculate the minimum value between the result and a given value.
     *
     * @param mixed $value The value to compare with.
     * @return self
     */
    public function minimum($value): self
    {
        $this->result = min($this->result, $this->convertToNumber($value));
        return $this;
    }

    /**
     * Calculate the percentage of the result.
     *
     * @param mixed $percent The percentage to calculate.
     * @return self
     */
    public function percentage($percent): self
    {
        $this->result = ($this->result * $this->convertToNumber($percent)) / 100;
        return $this;
    }

    /**
     * Add a percentage to the result.
     *
     * @param mixed $percent The percentage to add.
     * @return self
     */
    public function addPercentage($percent): self
    {
        $this->result += ($this->result * $this->convertToNumber($percent)) / 100;
        return $this;
    }

    /**
     * Subtract a percentage from the result.
     *
     * @param mixed $percent The percentage to subtract.
     * @return self
     */
    public function subtractPercentage($percent): self
    {
        $this->result -= ($this->result * $this->convertToNumber($percent)) / 100;
        return $this;
    }

    /**
     * Apply a discount to the result by subtracting a percentage.
     *
     * @param mixed $percent The percentage to subtract.
     * @return self
     */
    public function discount($percent): self
    {
        return $this->subtractPercentage($percent);
    }

    /**
     * Increase the result by a percentage.
     *
     * @param mixed $percent The percentage to add.
     * @return self
     */
    public function increaseByPercentage($percent): self
    {
        return $this->addPercentage($percent);
    }

    /**
     * Decrease the result by a percentage.
     *
     * @param mixed $percent The percentage to subtract.
     * @return self
     */
    public function decreaseByPercentage($percent): self
    {
        return $this->subtractPercentage($percent);
    }

    /**
     * Get the result of the arithmetic operations.
     *
     * @return float The result.
     */
    public function getResult(): float
    {
        return $this->applyRounding($this->result);
    }

    /**
     * Reset the result to a given value.
     *
     * @param mixed $value The value to reset to.
     * @return self
     */
    public function reset($value = C::DEFAULT_INITIAL_VALUE): self
    {
        $this->result = $this->convertToNumber($value);
        return $this;
    }

    /**
     * Get the string representation of the result.
     *
     * @return string The result as a string.
     */
    public function __toString(): string
    {
        return (string) $this->getResult();
    }

    /**
     * Get the formatted result.
     *
     * @param string $format The format type (int or string).
     * @return string|int The formatted result.
     */
    public function getFormattedResult(string $format = C::TYPE_INT): string|int
    {
        $result = $this->applyRounding($this->result);
        return $format == C::TYPE_INT ? (int)$result : (string)$result;
    }

    /**
     * Invoke the object to get the result.
     *
     * @return float The result.
     */
    public function __invoke(): float
    {
        return $this->getResult();
    }
}
