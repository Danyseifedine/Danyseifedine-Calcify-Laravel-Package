<?php

namespace Danyseif\Calcify\Interfaces;

use InvalidArgumentException;

interface MatrixOperationsInterface
{
    /**
     * Add two matrices.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @return array The resulting matrix after addition.
     * @throws InvalidArgumentException If the matrices are not of the same size.
     */
    public function add(array $matrixA, array $matrixB): array;

    /**
     * Subtract one matrix from another.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @return array The resulting matrix after subtraction.
     * @throws InvalidArgumentException If the matrices are not of the same size.
     */
    public function subtract(array $matrixA, array $matrixB): array;

    /**
     * Multiply two matrices.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @return array The resulting matrix after multiplication.
     * @throws InvalidArgumentException If the matrices cannot be multiplied.
     */
    public function multiply(array $matrixA, array $matrixB): array;

    /**
     * Transpose a matrix.
     *
     * @param array $matrix The matrix to transpose.
     * @return array The transposed matrix.
     */
    public function transpose(array $matrix): array;

    /**
     * Multiply a matrix by a scalar.
     *
     * @param array $matrix The matrix to multiply.
     * @param float|int $scalar The scalar value to multiply by.
     * @return array The resulting matrix after scalar multiplication.
     */
    public function scalarMultiply(array $matrix, $scalar): array;

    /**
     * Calculate the determinant of a square matrix.
     *
     * @param array $matrix The matrix to calculate the determinant of.
     * @return float|int The determinant of the matrix.
     * @throws InvalidArgumentException If the matrix is not square.
     */
    public function determinant(array $matrix);

    /**
     * Calculate the Frobenius norm of a matrix.
     *
     * @param array $matrix The matrix to calculate the norm of.
     * @return float The Frobenius norm of the matrix.
     */
    public function frobeniusNorm(array $matrix): float;

    /**
     * Calculate the rank of a matrix.
     *
     * @param array $matrix The matrix to calculate the rank of.
     * @return int The rank of the matrix.
     */
    public function rank(array $matrix): int;

    /**
     * Perform LU decomposition of a matrix.
     *
     * @param array $matrix The matrix to decompose.
     * @return array The LU decomposition of the matrix.
     */
    public function luDecomposition(array $matrix): array;

    /**
     * Perform Cholesky decomposition of a matrix.
     *
     * @param array $matrix The matrix to decompose.
     * @return array The Cholesky decomposition of the matrix.
     */
    public function choleskyDecomposition(array $matrix): array;

    /**
     * Calculate the Hadamard product (element-wise multiplication) of two matrices.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @return array The resulting matrix after Hadamard product.
     * @throws InvalidArgumentException If the matrices are not of the same size.
     */
    public function hadamardProduct(array $matrixA, array $matrixB): array;

    /**
     * Calculate the Kronecker product of two matrices.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @return array The resulting matrix after Kronecker product.
     */
    public function kroneckerProduct(array $matrixA, array $matrixB): array;

    /**
     * Calculate the trace of a square matrix.
     *
     * @param array $matrix The matrix to calculate the trace of.
     * @return float|int The trace of the matrix.
     * @throws InvalidArgumentException If the matrix is not square.
     */
    public function trace(array $matrix);

    public function formatMatrix(array $matrix): string;
}
