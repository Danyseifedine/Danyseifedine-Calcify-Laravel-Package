<?php

namespace Danyseif\Calcify\Interfaces;

interface PolynomialInterface
{
    /**
     * Add two polynomials.
     *
     * @param PolynomialInterface $other
     * @return PolynomialInterface
     */
    public function add(PolynomialInterface $other): PolynomialInterface;

    /**
     * Subtract one polynomial from another.
     *
     * @param PolynomialInterface $other
     * @return PolynomialInterface
     */
    public function subtract(PolynomialInterface $other): PolynomialInterface;

    /**
     * Multiply two polynomials.
     *
     * @param PolynomialInterface $other
     * @return PolynomialInterface
     */
    public function multiply(PolynomialInterface $other): PolynomialInterface;

    /**
     * Divide the polynomial by another polynomial.
     *
     * @param PolynomialInterface $other
     * @return array [PolynomialInterface $quotient, PolynomialInterface $remainder]
     */
    public function divide(PolynomialInterface $other): array;

    /**
     * Evaluate the polynomial at a given value.
     *
     * @param float $x
     * @return float
     */
    public function evaluate(float $x): float;

    /**
     * Get the degree of the polynomial.
     *
     * @return int
     */
    public function degree(): int;

    /**
     * Get the derivative of the polynomial.
     *
     * @return PolynomialInterface
     */
    public function derivative(): PolynomialInterface;

    /**
     * Get the integral of the polynomial.
     *
     * @param float $constant
     * @return PolynomialInterface
     */
    public function integral(float $constant = 0): PolynomialInterface;

    /**
     * Get the coefficients of the polynomial.
     *
     * @return array
     */
    public function getCoefficients(): array;

    /**
     * Get the string representation of the polynomial.
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * Add a constant to the polynomial.
     *
     * @param float $constant
     * @return PolynomialInterface
     */
    public function addConstant(float $constant): PolynomialInterface;

    /**
     * Subtract a constant from the polynomial.
     *
     * @param float $constant
     * @return PolynomialInterface
     */
    public function subtractConstant(float $constant): PolynomialInterface;

    /**
     * Multiply the polynomial by a constant.
     *
     * @param float $constant
     * @return PolynomialInterface
     */
    public function multiplyByConstant(float $constant): PolynomialInterface;

    /**
     * Divide the polynomial by a constant.
     *
     * @param float $constant
     * @return PolynomialInterface
     */
    public function divideByConstant(float $constant): PolynomialInterface;

    /**
     * Find the roots of the polynomial (only for quadratic polynomials).
     *
     * @return array
     */
    public function findRoots(): array;

    /**
     * Check if the polynomial is zero.
     *
     * @return bool
     */
    public function isZero(): bool;

    /**
     * Check if the polynomial is a constant.
     *
     * @return bool
     */
    public function isConstant(): bool;

    /**
     * Check if the polynomial is linear.
     *
     * @return bool
     */
    public function isLinear(): bool;

    /**
     * Check if the polynomial is quadratic.
     *
     * @return bool
     */
    public function isQuadratic(): bool;

    /**
     * Get the leading coefficient of the polynomial.
     *
     * @return float
     */
    public function leadingCoefficient(): float;

    /**
     * Get the constant term of the polynomial.
     *
     * @return float
     */
    public function constantTerm(): float;
}
