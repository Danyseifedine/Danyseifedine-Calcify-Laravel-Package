<?php

namespace Danyseif\Calcify\Base;

use Danyseif\Calcify\Interfaces\PolynomialInterface;


/**
 * Class Polynomial
 *
 * This class represents a polynomial and provides methods to perform various operations on polynomials,
 * such as addition, subtraction, multiplication, division, evaluation, and finding roots.
 *
 * Available methods:
 * - `add(Polynomial $other): Polynomial` - Add two polynomials.
 * - `subtract(Polynomial $other): Polynomial` - Subtract one polynomial from another.
 * - `multiply(Polynomial $other): Polynomial` - Multiply two polynomials.
 * - `divide(Polynomial $other): array` - Divide the polynomial by another polynomial.
 * - `evaluate(float $x): float` - Evaluate the polynomial at a given value.
 * - `degree(): int` - Get the degree of the polynomial.
 * - `derivative(): Polynomial` - Get the derivative of the polynomial.
 * - `findRoots(): array` - Find the roots of the polynomial (only for quadratic polynomials).
 * - `isZero(): bool` - Check if the polynomial is zero.
 * - `isConstant(): bool` - Check if the polynomial is a constant.
 * - `isLinear(): bool` - Check if the polynomial is linear.
 * - `isQuadratic(): bool` - Check if the polynomial is quadratic.
 * - `leadingCoefficient(): float` - Get the leading coefficient of the polynomial.
 * - `constantTerm(): float` - Get the constant term of the polynomial.
 */

class Polynomial implements PolynomialInterface
{
    private array $coefficients;

    public function __construct(array $coefficients)
    {
        $this->coefficients = $coefficients;
    }

    /**
     * Add two polynomials.
     *
     * @param Polynomial $other
     * @return Polynomial
     */
    public function add($other): Polynomial
    {
        $result = [];
        $maxDegree = max(count($this->coefficients), count($other->coefficients));

        for ($i = 0; $i < $maxDegree; $i++) {
            $result[$i] = ($this->coefficients[$i] ?? 0) + ($other->coefficients[$i] ?? 0);
        }

        return new self($result);
    }

    /**
     * Subtract one polynomial from another.
     *
     * @param Polynomial $other
     * @return Polynomial
     */
    public function subtract($other): Polynomial
    {
        $result = [];
        $maxDegree = max(count($this->coefficients), count($other->coefficients));

        for ($i = 0; $i < $maxDegree; $i++) {
            $result[$i] = ($this->coefficients[$i] ?? 0) - ($other->coefficients[$i] ?? 0);
        }

        return new self($result);
    }

    /**
     * Multiply two polynomials.
     *
     * @param Polynomial $other
     * @return Polynomial
     */
    public function multiply($other): Polynomial
    {
        $result = array_fill(0, count($this->coefficients) + count($other->coefficients) - 1, 0);

        for ($i = 0; $i < count($this->coefficients); $i++) {
            for ($j = 0; $j < count($other->coefficients); $j++) {
                $result[$i + $j] += $this->coefficients[$i] * $other->coefficients[$j];
            }
        }

        return new self($result);
    }

    /**
     * Divide the polynomial by another polynomial.
     *
     * @param Polynomial $other
     * @return array [Polynomial $quotient, Polynomial $remainder]
     */
    public function divide($other): array
    {
        $quotient = [];
        $remainder = $this->coefficients;

        while (count($remainder) >= count($other->coefficients)) {
            $leadCoeff = end($remainder) / end($other->coefficients);
            $degreeDiff = count($remainder) - count($other->coefficients);
            $quotient[$degreeDiff] = $leadCoeff;

            for ($i = 0; $i < count($other->coefficients); $i++) {
                $remainder[$i + $degreeDiff] -= $leadCoeff * $other->coefficients[$i];
            }

            array_pop($remainder);
        }

        return [new self($quotient), new self($remainder)];
    }

    /**
     * Evaluate the polynomial at a given value.
     *
     * @param float $x
     * @return float
     */
    public function evaluate(float $x): float
    {
        $result = 0;
        foreach ($this->coefficients as $power => $coefficient) {
            $result += $coefficient * pow($x, $power);
        }
        return $result;
    }

    /**
     * Get the degree of the polynomial.
     *
     * @return int
     */
    public function degree(): int
    {
        return count($this->coefficients) - 1;
    }

    /**
     * Get the derivative of the polynomial.
     *
     * @return Polynomial
     */
    public function derivative(): Polynomial
    {
        $result = [];
        foreach ($this->coefficients as $power => $coefficient) {
            if ($power > 0) {
                $result[$power - 1] = $coefficient * $power;
            }
        }
        return new self($result);
    }

    /**
     * Get the integral of the polynomial.
     *
     * @param float $constant
     * @return Polynomial
     */
    public function integral(float $constant = 0): Polynomial
    {
        $result = [$constant];
        foreach ($this->coefficients as $power => $coefficient) {
            $result[$power + 1] = $coefficient / ($power + 1);
        }
        return new self($result);
    }

    /**
     * Get the coefficients of the polynomial.
     *
     * @return array
     */
    public function getCoefficients(): array
    {
        return $this->coefficients;
    }

    /**
     * Get the string representation of the polynomial.
     *
     * @return string
     */
    public function __toString(): string
    {
        $terms = [];
        foreach ($this->coefficients as $power => $coefficient) {
            $terms[] = "{$coefficient}x^{$power}";
        }
        return implode(' + ', $terms);
    }

    /**
     * Add a constant to the polynomial.
     *
     * @param float $constant
     * @return Polynomial
     */
    public function addConstant(float $constant): Polynomial
    {
        $result = $this->coefficients;
        $result[0] = ($result[0] ?? 0) + $constant;
        return new self($result);
    }

    /**
     * Subtract a constant from the polynomial.
     *
     * @param float $constant
     * @return Polynomial
     */
    public function subtractConstant(float $constant): Polynomial
    {
        $result = $this->coefficients;
        $result[0] = ($result[0] ?? 0) - $constant;
        return new self($result);
    }

    /**
     * Multiply the polynomial by a constant.
     *
     * @param float $constant
     * @return Polynomial
     */
    public function multiplyByConstant(float $constant): Polynomial
    {
        $result = [];
        foreach ($this->coefficients as $power => $coefficient) {
            $result[$power] = $coefficient * $constant;
        }
        return new self($result);
    }

    /**
     * Divide the polynomial by a constant.
     *
     * @param float $constant
     * @return Polynomial
     */
    public function divideByConstant(float $constant): Polynomial
    {
        $result = [];
        foreach ($this->coefficients as $power => $coefficient) {
            $result[$power] = $coefficient / $constant;
        }
        return new self($result);
    }

    /**
     * Find the roots of the polynomial (only for quadratic polynomials).
     *
     * @return array
     */
    public function findRoots(): array
    {
        if ($this->degree() != 2) {
            throw new \InvalidArgumentException("This method only supports quadratic polynomials.");
        }

        $a = $this->coefficients[2] ?? 0;
        $b = $this->coefficients[1] ?? 0;
        $c = $this->coefficients[0] ?? 0;

        $discriminant = $b * $b - 4 * $a * $c;
        if ($discriminant < 0) {
            return []; // No real roots
        }

        $root1 = (-$b + sqrt($discriminant)) / (2 * $a);
        $root2 = (-$b - sqrt($discriminant)) / (2 * $a);

        return [$root1, $root2];
    }

    /**
     * Check if the polynomial is zero.
     *
     * @return bool
     */
    public function isZero(): bool
    {
        foreach ($this->coefficients as $coefficient) {
            if ($coefficient != 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check if the polynomial is a constant.
     *
     * @return bool
     */
    public function isConstant(): bool
    {
        return count($this->coefficients) == 1;
    }

    /**
     * Check if the polynomial is linear.
     *
     * @return bool
     */
    public function isLinear(): bool
    {
        return count($this->coefficients) == 2;
    }

    /**
     * Check if the polynomial is quadratic.
     *
     * @return bool
     */
    public function isQuadratic(): bool
    {
        return count($this->coefficients) == 3;
    }

    /**
     * Get the leading coefficient of the polynomial.
     *
     * @return float
     */
    public function leadingCoefficient(): float
    {
        return end($this->coefficients);
    }

    /**
     * Get the constant term of the polynomial.
     *
     * @return float
     */
    public function constantTerm(): float
    {
        return $this->coefficients[0] ?? 0;
    }
}
