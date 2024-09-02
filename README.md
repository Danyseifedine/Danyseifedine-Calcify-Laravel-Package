# Calcify

Calcify is a PHP package that provides various mathematical and statistical functions. It includes classes for performing operations on polynomials, matrices, and arithmetic calculations. It also includes an interface for statistical calculations such as mean, median, mode, variance, and standard deviation. The package is designed to be used in Laravel applications and can be installed via Composer.

## Features

- Polynomial operations: addition, subtraction, multiplication, division, evaluation, and finding roots.
- Matrix operations: addition, subtraction, multiplication, transposition, inversion, determinant calculation, rank calculation, LU decomposition, Cholesky decomposition, Hadamard product, Kronecker product, trace calculation, and matrix formatting.
- Arithmetic operations: addition, subtraction, multiplication, division, modulo, power, root, logarithms, trigonometric functions, hyperbolic functions, factorial, absolute value, and percentage calculations.
- Statistical calculations: mean, median, mode, range, variance, standard deviation, sample variance, sample standard deviation, coefficient of variation, and weighted mean.

## Installation

You can install the package via Composer:

```bash
composer require danyseif/calcify
```

## Usage

### Polynomial Operations

```php

use Danyseif\Calcify\Base\Polynomial;

$polynomial1 = new Polynomial([1, 2, 3]); // 1x^2 + 2x + 3
$polynomial2 = new Polynomial([4, 5, 6]); // 4x^2 + 5x + 6

$sum = $polynomial1->add($polynomial2);
echo $sum; // 5x^2 + 7x + 9

//  Available methods:
// * - `add(Polynomial $other): Polynomial` - Add two polynomials.
// * - `subtract(Polynomial $other): Polynomial` - Subtract one polynomial from another.
// * - `multiply(Polynomial $other): Polynomial` - Multiply two polynomials.
// * - `divide(Polynomial $other): array` - Divide the polynomial by another polynomial.
// * - `evaluate(float $x): float` - Evaluate the polynomial at a given value.
// * - `degree(): int` - Get the degree of the polynomial.
// * - `derivative(): Polynomial` - Get the derivative of the polynomial.
// * - `findRoots(): array` - Find the roots of the polynomial (only for quadratic polynomials).
// * - `isZero(): bool` - Check if the polynomial is zero.
// * - `isConstant(): bool` - Check if the polynomial is a constant.
// * - `isLinear(): bool` - Check if the polynomial is linear.
// * - `isQuadratic(): bool` - Check if the polynomial is quadratic.
// * - `leadingCoefficient(): float` - Get the leading coefficient of the polynomial.
// * - `constantTerm(): float` - Get the constant term of the polynomial.
```

### Matrix Operations

```php

use Danyseif\Calcify\Base\Matrix;

$matrixOps = new MatrixOperations();

$matrixA = [
[1, 2],
[3, 4]
];
$matrixB = [
[5, 6],
[7, 8]
];


$sum = $matrixOps->add($matrixA, $matrixB);
$diff = $matrixOps->subtract($matrixA, $matrixB);
$product = $matrixOps->multiply($matrixA, $matrixB);
$transpose = $matrixOps->transpose($matrixA);
$inverse = $matrixOps->inverse($matrixA);
$determinant = $matrixOps->determinant($matrixA);
$rank = $matrixOps->rank($matrixA);
$luDecomposition = $matrixOps->luDecomposition($matrixA);
$choleskyDecomposition = $matrixOps->choleskyDecomposition($matrixA);
$hadamardProduct = $matrixOps->hadamardProduct($matrixA, $matrixB);
$kroneckerProduct = $matrixOps->kroneckerProduct($matrixA, $matrixB);
$trace = $matrixOps->trace($matrixA);
$formattedMatrix = $matrixOps->formatMatrix($matrixA);

// * Available methods:
// * - `add(array $matrixA, array $matrixB): array`
// * - `subtract(array $matrixA, array $matrixB): array`
// * - `multiply(array $matrixA, array $matrixB): array`
// * - `transpose(array $matrix): array`
// * - `inverse(array $matrix): array`
// * - `determinant(array $matrix): float`
// * - `rank(array $matrix): int`
// * - `luDecomposition(array $matrix): array`
// * - `choleskyDecomposition(array $matrix): array`
// * - `hadamardProduct(array $matrixA, array $matrixB): array`
// * - `kroneckerProduct(array $matrixA, array $matrixB): array`
// * - `trace(array $matrix): float|int`
// * - `formatMatrix(array $matrix): string`
```

### Arithmetic Operations

```php

use Danyseif\Calcify\Base\Arithmetic;

$arithmetic = new Arithmetic(10);
$result = $arithmetic->add(5)
->subtract(3)
->multiply(2)
->divide(4)
->getResult();

//  * Available methods:

//  * - `create(float $initialValue, bool $isRounded, string $roundingMode, int $decimalPlaces): self`
//  * - `enableRounding(string $roundingMode): self`
//  * - `disableRounding(int $decimalPlaces): self`
//  * - `add($value): self`
//  * - `subtract($value): self`
//  * - `multiply($value): self`
//  * - `divide($value): self`
//  * - `modulo($value): self`
//  * - `power($value): self`
//  * - `root($value): self`
//  * - `logarithm($base): self`
//  * - `naturalLogarithm(): self`
//  * - `commonLogarithm(): self`
//  * - `exponential(): self`
//  * - `sine(): self`
//  * - `cosine(): self`
//  * - `tangent(): self`
//  * - `cotangent(): self`
//  * - `secant(): self`
//  * - `cosecant(): self`
//  * - `arcsine(): self`
//  * - `arccosine(): self`
//  * - `arctangent(): self`
//  * - `arccotangent(): self`
//  * - `arcsecant(): self`
//  * - `arccosecant(): self`
//  * - `hyperbolicSine(): self`
//  * - `hyperbolicCosine(): self`
//  * - `hyperbolicTangent(): self`
//  * - `hyperbolicCotangent(): self`
//  * - `hyperbolicSecant(): self`
//  * - `hyperbolicCosecant(): self`
//  * - `inverseHyperbolicSine(): self`
//  * - `inverseHyperbolicCosine(): self`
//  * - `inverseHyperbolicTangent(): self`
//  * - `inverseHyperbolicCotangent(): self`
//  * - `inverseHyperbolicSecant(): self`
//  * - `inverseHyperbolicCosecant(): self`
//  * - `factorial(): self`
//  * - `absolute(): self`
//  * - `maximum($value): self`
//  * - `minimum($value): self`
//  * - `percentage($percent): self`
//  * - `addPercentage($percent): self`
//  * - `subtractPercentage($percent): self`
//  * - `discount($percent): self`
//  * - `increaseByPercentage($percent): self`
//  * - `decreaseByPercentage($percent): self`
//  * - `getResult(): float`
//  * - `reset($value): self`
//  * - `__toString(): string`
//  * - `getFormattedResult(string $format): string|int`
//  * - `__invoke(): float`
```

### Statistical Calculations

```php

use Danyseif\Calcify\Base\Statistics;
$stats = new Statistics();
$numbers = [1, 2, 3, 4, 5];
$mean = $stats->mean($numbers);
$median = $stats->median($numbers);
$mode = $stats->mode($numbers);
$range = $stats->range($numbers);
$variance = $stats->variance($numbers);
$stdDev = $stats->standardDeviation($numbers);
$sampleVariance = $stats->sampleVariance($numbers);
$sampleStdDev = $stats->sampleStandardDeviation($numbers);
$coefficientOfVariation = $stats->coefficientOfVariation($numbers);
$weightedMean = $stats->weightedMean($numbers, [1, 1, 1, 1, 1]);

//  * Available methods:
//  * - `mean(array $numbers): float` - Calculate the mean of an array of numbers.
//  * - `median(array $numbers): float` - Calculate the median of an array of numbers.
//  * - `mode(array $numbers): array` - Calculate the mode of an array of numbers.
//  * - `range(array $numbers): float` - Calculate the range of an array of numbers.
//  * - `variance(array $numbers): float` - Calculate the variance of an array of numbers.
//  * - `standardDeviation(array $numbers): float` - Calculate the standard deviation of an array of numbers.
//  * - `sampleVariance(array $numbers): float` - Calculate the sample variance of an array of numbers.
//  * - `sampleStandardDeviation(array $numbers): float` - Calculate the sample standard deviation of an array of numbers.
//  * - `coefficientOfVariation(array $numbers): float` - Calculate the coefficient of variation of an array of numbers.
//  * - `weightedMean(array $numbers, array $weights): float` - Calculate the weighted mean of an array of numbers with corresponding weights.
```

## Laravel Integration

Calcify can be easily integrated into Laravel applications. The package includes a service provider that can be registered in your `config/app.php` file:

```php

use Danyseif\Calcify\Providers\CalcifyServiceProvider;

return [
    // Other service providers...
    CalcifyServiceProvider::class,
]

```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Author

Dany Seifeddine
