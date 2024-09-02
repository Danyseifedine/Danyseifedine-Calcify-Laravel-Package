<?php

namespace Danyseif\Calcify\Base;

use Danyseif\Calcify\Interfaces\MatrixOperationsInterface;
use InvalidArgumentException;

/**
 * Class MatrixOperations
 *
 * This class provides various matrix operations including addition, subtraction,
 * multiplication, transposition, inversion, determinant calculation, rank calculation,
 * LU decomposition, Cholesky decomposition, Hadamard product, Kronecker product,
 * trace calculation, and matrix formatting.
 *
 * Available methods:
 * - `add(array $matrixA, array $matrixB): array`
 * - `subtract(array $matrixA, array $matrixB): array`
 * - `multiply(array $matrixA, array $matrixB): array`
 * - `transpose(array $matrix): array`
 * - `inverse(array $matrix): array`
 * - `determinant(array $matrix): float`
 * - `rank(array $matrix): int`
 * - `luDecomposition(array $matrix): array`
 * - `choleskyDecomposition(array $matrix): array`
 * - `hadamardProduct(array $matrixA, array $matrixB): array`
 * - `kroneckerProduct(array $matrixA, array $matrixB): array`
 * - `trace(array $matrix): float|int`
 * - `formatMatrix(array $matrix): string`
 */

class MatrixOperations implements MatrixOperationsInterface
{

    /**
     * Add two matrices.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @return array The resulting matrix after addition.
     * @throws InvalidArgumentException If the matrices are not of the same size.
     */
    public function add(array $matrixA, array $matrixB): array
    {
        $this->validateSameSize($matrixA, $matrixB);

        $result = [];
        foreach ($matrixA as $i => $row) {
            foreach ($row as $j => $value) {
                $result[$i][$j] = $value + $matrixB[$i][$j];
            }
        }

        return $result;
    }

    /**
     * Subtract one matrix from another.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @return array The resulting matrix after subtraction.
     * @throws InvalidArgumentException If the matrices are not of the same size.
     */
    public function subtract(array $matrixA, array $matrixB): array
    {
        $this->validateSameSize($matrixA, $matrixB);

        $result = [];
        foreach ($matrixA as $i => $row) {
            foreach ($row as $j => $value) {
                $result[$i][$j] = $value - $matrixB[$i][$j];
            }
        }

        return $result;
    }

    /**
     * Multiply two matrices.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @return array The resulting matrix after multiplication.
     * @throws InvalidArgumentException If the matrices cannot be multiplied.
     */
    public function multiply(array $matrixA, array $matrixB): array
    {
        $this->validateMultiplicationSize($matrixA, $matrixB);

        $result = [];
        $rowCountA = count($matrixA);
        $colCountB = count($matrixB[0]);
        $colCountA = count($matrixA[0]);

        for ($i = 0; $i < $rowCountA; $i++) {
            for ($j = 0; $j < $colCountB; $j++) {
                $result[$i][$j] = 0;
                for ($k = 0; $k < $colCountA; $k++) {
                    $result[$i][$j] += $matrixA[$i][$k] * $matrixB[$k][$j];
                }
            }
        }

        return $result;
    }

    /**
     * Transpose a matrix.
     *
     * @param array $matrix The matrix to transpose.
     * @return array The transposed matrix.
     */
    public function transpose(array $matrix): array
    {
        $result = [];
        foreach ($matrix as $i => $row) {
            foreach ($row as $j => $value) {
                $result[$j][$i] = $value;
            }
        }

        return $result;
    }

    /**
     * Multiply a matrix by a scalar.
     *
     * @param array $matrix The matrix to multiply.
     * @param float|int $scalar The scalar value to multiply by.
     * @return array The resulting matrix after scalar multiplication.
     */
    public function scalarMultiply(array $matrix, $scalar): array
    {
        $result = [];
        foreach ($matrix as $i => $row) {
            foreach ($row as $j => $value) {
                $result[$i][$j] = $value * $scalar;
            }
        }

        return $result;
    }

    /**
     * Calculate the determinant of a square matrix.
     *
     * @param array $matrix The matrix to calculate the determinant of.
     * @return float|int The determinant of the matrix.
     * @throws InvalidArgumentException If the matrix is not square.
     */
    public function determinant(array $matrix)
    {
        $this->validateSquareMatrix($matrix);

        $n = count($matrix);
        if ($n == 1) {
            return $matrix[0][0];
        } elseif ($n == 2) {
            return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
        } else {
            $det = 0;
            for ($i = 0; $i < $n; $i++) {
                $subMatrix = $this->getSubMatrix($matrix, 0, $i);
                $det += pow(-1, $i) * $matrix[0][$i] * $this->determinant($subMatrix);
            }
            return $det;
        }
    }

    /**
     * Calculate the Frobenius norm of a matrix.
     *
     * @param array $matrix The matrix to calculate the norm of.
     * @return float The Frobenius norm of the matrix.
     */
    public function frobeniusNorm(array $matrix): float
    {
        $sum = 0;
        foreach ($matrix as $row) {
            foreach ($row as $value) {
                $sum += $value * $value;
            }
        }
        return sqrt($sum);
    }

    /**
     * Calculate the rank of a matrix.
     *
     * @param array $matrix The matrix to calculate the rank of.
     * @return int The rank of the matrix.
     */
    public function rank(array $matrix): int
    {
        // Implement rank calculation using Gaussian elimination
        $rowCount = count($matrix);
        $colCount = count($matrix[0]);
        $rank = 0;

        for ($row = 0; $row < $rowCount; $row++) {
            if ($matrix[$row][$rank] != 0) {
                for ($col = 0; $col < $rowCount; $col++) {
                    if ($col != $row) {
                        $multiplier = $matrix[$col][$rank] / $matrix[$row][$rank];
                        for ($i = 0; $i < $colCount; $i++) {
                            $matrix[$col][$i] -= $multiplier * $matrix[$row][$i];
                        }
                    }
                }
                $rank++;
            }
        }

        return $rank;
    }

    /**
     * Perform LU decomposition of a matrix.
     *
     * @param array $matrix The matrix to decompose.
     * @return array The LU decomposition of the matrix.
     */
    public function luDecomposition(array $matrix): array
    {
        $n = count($matrix);
        $L = array_fill(0, $n, array_fill(0, $n, 0));
        $U = array_fill(0, $n, array_fill(0, $n, 0));

        for ($i = 0; $i < $n; $i++) {
            for ($k = $i; $k < $n; $k++) {
                $sum = 0;
                for ($j = 0; $j < $i; $j++) {
                    $sum += ($L[$i][$j] * $U[$j][$k]);
                }
                $U[$i][$k] = $matrix[$i][$k] - $sum;
            }

            for ($k = $i; $k < $n; $k++) {
                if ($i == $k) {
                    $L[$i][$i] = 1;
                } else {
                    $sum = 0;
                    for ($j = 0; $j < $i; $j++) {
                        $sum += ($L[$k][$j] * $U[$j][$i]);
                    }
                    $L[$k][$i] = ($matrix[$k][$i] - $sum) / $U[$i][$i];
                }
            }
        }

        return ['L' => $L, 'U' => $U];
    }

    /**
     * Perform Cholesky decomposition of a matrix.
     *
     * @param array $matrix The matrix to decompose.
     * @return array The Cholesky decomposition of the matrix.
     */
    public function choleskyDecomposition(array $matrix): array
    {
        $n = count($matrix);
        $L = array_fill(0, $n, array_fill(0, $n, 0));

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j <= $i; $j++) {
                $sum = 0;
                for ($k = 0; $k < $j; $k++) {
                    $sum += $L[$i][$k] * $L[$j][$k];
                }
                if ($i == $j) {
                    $L[$i][$j] = sqrt(max($matrix[$i][$i] - $sum, 0));
                } else {
                    $L[$i][$j] = ($matrix[$i][$j] - $sum) / ($L[$j][$j] ?: 1);
                }
            }
        }

        return $L;
    }

    /**
     * Calculate the Hadamard product (element-wise multiplication) of two matrices.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @return array The resulting matrix after Hadamard product.
     * @throws InvalidArgumentException If the matrices are not of the same size.
     */
    public function hadamardProduct(array $matrixA, array $matrixB): array
    {
        $this->validateSameSize($matrixA, $matrixB);

        $result = [];
        foreach ($matrixA as $i => $row) {
            foreach ($row as $j => $value) {
                $result[$i][$j] = $value * $matrixB[$i][$j];
            }
        }

        return $result;
    }

    /**
     * Calculate the Kronecker product of two matrices.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @return array The resulting matrix after Kronecker product.
     */
    public function kroneckerProduct(array $matrixA, array $matrixB): array
    {
        $result = [];
        foreach ($matrixA as $i => $rowA) {
            foreach ($matrixB as $j => $rowB) {
                foreach ($rowA as $k => $valueA) {
                    foreach ($rowB as $l => $valueB) {
                        $result[$i * count($matrixB) + $j][$k * count($rowB) + $l] = $valueA * $valueB;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Validate that two matrices are of the same size.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @throws InvalidArgumentException If the matrices are not of the same size.
     */
    private function validateSameSize(array $matrixA, array $matrixB): void
    {
        if (count($matrixA) !== count($matrixB) || count($matrixA[0]) !== count($matrixB[0])) {
            throw new InvalidArgumentException("Matrices must be of the same size.");
        }
    }

    /**
     * Validate that two matrices can be multiplied.
     *
     * @param array $matrixA The first matrix.
     * @param array $matrixB The second matrix.
     * @throws InvalidArgumentException If the matrices cannot be multiplied.
     */
    private function validateMultiplicationSize(array $matrixA, array $matrixB): void
    {
        if (count($matrixA[0]) !== count($matrixB)) {
            throw new InvalidArgumentException("Number of columns in the first matrix must be equal to the number of rows in the second matrix.");
        }
    }

    /**
     * Calculate the trace of a square matrix.
     *
     * @param array $matrix The matrix to calculate the trace of.
     * @return float|int The trace of the matrix.
     * @throws InvalidArgumentException If the matrix is not square.
     */
    public function trace(array $matrix)
    {
        $this->validateSquareMatrix($matrix);

        $trace = 0;
        for ($i = 0; $i < count($matrix); $i++) {
            $trace += $matrix[$i][$i];
        }

        return $trace;
    }

    /**
     * Validate that a matrix is square.
     *
     * @param array $matrix The matrix to validate.
     * @throws InvalidArgumentException If the matrix is not square.
     */
    private function validateSquareMatrix(array $matrix): void
    {
        if (count($matrix) !== count($matrix[0])) {
            throw new InvalidArgumentException("Matrix must be square.");
        }
    }

    /**
     * Get the submatrix by removing the specified row and column.
     *
     * @param array $matrix The original matrix.
     * @param int $row The row to remove.
     * @param int $col The column to remove.
     * @return array The submatrix.
     */
    private function getSubMatrix(array $matrix, int $row, int $col): array
    {
        $subMatrix = [];
        foreach ($matrix as $i => $r) {
            if ($i == $row) continue;
            $subMatrix[] = array_values(array_diff_key($r, [$col => $r[$col]]));
        }
        return $subMatrix;
    }

    /**
     * Format a matrix as a string representation.
     *
     * @param array $matrix The matrix to format.
     * @return string The formatted string representation of the matrix.
     */
    public function formatMatrix(array $matrix): string
    {
        $result = '';
        foreach ($matrix as $row) {
            $result .= '[' . implode(',', $row) . "]\n";
        }
        return rtrim($result);
    }
}
