<?php

namespace Danyseif\Calcify\Base;

use Danyseif\Calcify\Interfaces\StatisticsInterface;

/**
 * Class Statistics
 *
 * This class provides various statistical calculations including mean, median, mode,
 * range, variance, standard deviation, sample variance, sample standard deviation,
 * coefficient of variation, and weighted mean.
 *
 * Available methods:
 * - `mean(array $numbers): float` - Calculate the mean of an array of numbers.
 * - `median(array $numbers): float` - Calculate the median of an array of numbers.
 * - `mode(array $numbers): array` - Calculate the mode of an array of numbers.
 * - `range(array $numbers): float` - Calculate the range of an array of numbers.
 * - `variance(array $numbers): float` - Calculate the variance of an array of numbers.
 * - `standardDeviation(array $numbers): float` - Calculate the standard deviation of an array of numbers.
 * - `sampleVariance(array $numbers): float` - Calculate the sample variance of an array of numbers.
 * - `sampleStandardDeviation(array $numbers): float` - Calculate the sample standard deviation of an array of numbers.
 * - `coefficientOfVariation(array $numbers): float` - Calculate the coefficient of variation of an array of numbers.
 * - `weightedMean(array $numbers, array $weights): float` - Calculate the weighted mean of an array of numbers with corresponding weights.
 */

class Statistics implements StatisticsInterface
{
    /**
     * Calculate the mean of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function mean(array $numbers): float
    {
        return array_sum($numbers) / count($numbers);
    }

    /**
     * Calculate the median of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function median(array $numbers): float
    {
        sort($numbers);
        $count = count($numbers);
        $middle = floor(($count - 1) / 2);

        if ($count % 2) {
            return $numbers[$middle];
        } else {
            return ($numbers[$middle] + $numbers[$middle + 1]) / 2.0;
        }
    }

    /**
     * Calculate the mode of an array of numbers.
     *
     * @param array $numbers
     * @return array
     */
    public function mode(array $numbers): array
    {
        $values = array_count_values($numbers);
        $mode = array_keys($values, max($values));
        return $mode;
    }

    /**
     * Calculate the range of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function range(array $numbers): float
    {
        return max($numbers) - min($numbers);
    }

    /**
     * Calculate the variance of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function variance(array $numbers): float
    {
        $mean = $this->mean($numbers);
        $sum = 0;

        foreach ($numbers as $number) {
            $sum += pow($number - $mean, 2);
        }

        return $sum / count($numbers);
    }

    /**
     * Calculate the standard deviation of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function standardDeviation(array $numbers): float
    {
        return sqrt($this->variance($numbers));
    }

    /**
     * Calculate the skewness of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function skewness(array $numbers): float
    {
        $mean = $this->mean($numbers);
        $stdDev = $this->standardDeviation($numbers);
        $n = count($numbers);
        $sum = 0;

        foreach ($numbers as $number) {
            $sum += pow(($number - $mean) / $stdDev, 3);
        }

        return $sum / $n;
    }

    /**
     * Calculate the kurtosis of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function kurtosis(array $numbers): float
    {
        $mean = $this->mean($numbers);
        $stdDev = $this->standardDeviation($numbers);
        $n = count($numbers);
        $sum = 0;

        foreach ($numbers as $number) {
            $sum += pow(($number - $mean) / $stdDev, 4);
        }

        return $sum / $n - 3;
    }

    /**
     * Calculate the percentile of an array of numbers.
     *
     * @param array $numbers
     * @param float $percentile
     * @return float
     */
    public function percentile(array $numbers, float $percentile): float
    {
        sort($numbers);
        $index = ($percentile / 100) * (count($numbers) - 1);
        $floorIndex = floor($index);
        $ceilIndex = ceil($index);

        if ($floorIndex == $ceilIndex) {
            return $numbers[$index];
        }

        return $numbers[$floorIndex] * ($ceilIndex - $index) + $numbers[$ceilIndex] * ($index - $floorIndex);
    }

    /**
     * Calculate the interquartile range (IQR) of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function interquartileRange(array $numbers): float
    {
        $q1 = $this->percentile($numbers, 25);
        $q3 = $this->percentile($numbers, 75);
        return $q3 - $q1;
    }

    /**
     * Calculate the covariance between two arrays of numbers.
     *
     * @param array $x
     * @param array $y
     * @return float
     */
    public function covariance(array $x, array $y): float
    {
        $meanX = $this->mean($x);
        $meanY = $this->mean($y);
        $n = count($x);
        $sum = 0;

        for ($i = 0; $i < $n; $i++) {
            $sum += ($x[$i] - $meanX) * ($y[$i] - $meanY);
        }

        return $sum / $n;
    }

    /**
     * Calculate the correlation coefficient between two arrays of numbers.
     *
     * @param array $x
     * @param array $y
     * @return float
     */
    public function correlation(array $x, array $y): float
    {
        $covariance = $this->covariance($x, $y);
        $stdDevX = $this->standardDeviation($x);
        $stdDevY = $this->standardDeviation($y);

        return $covariance / ($stdDevX * $stdDevY);
    }

    /**
     * Calculate the z-score of a value in an array of numbers.
     *
     * @param float $value
     * @param array $numbers
     * @return float
     */
    public function zScore(float $value, array $numbers): float
    {
        $mean = $this->mean($numbers);
        $stdDev = $this->standardDeviation($numbers);

        return ($value - $mean) / $stdDev;
    }

    /**
     * Calculate the mean absolute deviation of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function meanAbsoluteDeviation(array $numbers): float
    {
        $mean = $this->mean($numbers);
        $sum = 0;

        foreach ($numbers as $number) {
            $sum += abs($number - $mean);
        }

        return $sum / count($numbers);
    }

    /**
     * Calculate the geometric mean of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function geometricMean(array $numbers): float
    {
        $product = array_product($numbers);
        return pow($product, 1 / count($numbers));
    }

    /**
     * Calculate the harmonic mean of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function harmonicMean(array $numbers): float
    {
        $sum = 0;

        foreach ($numbers as $number) {
            $sum += 1 / $number;
        }

        return count($numbers) / $sum;
    }

    /**
     * Calculate the sample variance of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function sampleVariance(array $numbers): float
    {
        $mean = $this->mean($numbers);
        $sum = 0;

        foreach ($numbers as $number) {
            $sum += pow($number - $mean, 2);
        }

        return $sum / (count($numbers) - 1);
    }

    /**
     * Calculate the sample standard deviation of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function sampleStandardDeviation(array $numbers): float
    {
        return sqrt($this->sampleVariance($numbers));
    }

    /**
     * Calculate the coefficient of variation of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function coefficientOfVariation(array $numbers): float
    {
        $mean = $this->mean($numbers);
        $stdDev = $this->standardDeviation($numbers);

        return $stdDev / $mean;
    }

    /**
     * Calculate the weighted mean of an array of numbers with corresponding weights.
     *
     * @param array $numbers
     * @param array $weights
     * @return float
     */
    public function weightedMean(array $numbers, array $weights): float
    {
        $sum = 0;
        $weightSum = 0;

        for ($i = 0; $i < count($numbers); $i++) {
            $sum += $numbers[$i] * $weights[$i];
            $weightSum += $weights[$i];
        }

        return $sum / $weightSum;
    }
}
