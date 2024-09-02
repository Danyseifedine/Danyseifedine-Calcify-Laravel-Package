<?php

namespace Danyseif\Calcify\Interfaces;

interface StatisticsInterface
{
    /**
     * Calculate the mean of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function mean(array $numbers): float;

    /**
     * Calculate the median of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function median(array $numbers): float;

    /**
     * Calculate the mode of an array of numbers.
     *
     * @param array $numbers
     * @return array
     */
    public function mode(array $numbers): array;

    /**
     * Calculate the range of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function range(array $numbers): float;

    /**
     * Calculate the variance of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function variance(array $numbers): float;

    /**
     * Calculate the standard deviation of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function standardDeviation(array $numbers): float;

    /**
     * Calculate the skewness of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function skewness(array $numbers): float;

    /**
     * Calculate the kurtosis of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function kurtosis(array $numbers): float;

    /**
     * Calculate the percentile of an array of numbers.
     *
     * @param array $numbers
     * @param float $percentile
     * @return float
     */
    public function percentile(array $numbers, float $percentile): float;

    /**
     * Calculate the interquartile range (IQR) of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function interquartileRange(array $numbers): float;

    /**
     * Calculate the covariance between two arrays of numbers.
     *
     * @param array $x
     * @param array $y
     * @return float
     */
    public function covariance(array $x, array $y): float;

    /**
     * Calculate the correlation coefficient between two arrays of numbers.
     *
     * @param array $x
     * @param array $y
     * @return float
     */
    public function correlation(array $x, array $y): float;

    /**
     * Calculate the z-score of a value in an array of numbers.
     *
     * @param float $value
     * @param array $numbers
     * @return float
     */
    public function zScore(float $value, array $numbers): float;

    /**
     * Calculate the mean absolute deviation of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function meanAbsoluteDeviation(array $numbers): float;

    /**
     * Calculate the geometric mean of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function geometricMean(array $numbers): float;

    /**
     * Calculate the harmonic mean of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function harmonicMean(array $numbers): float;

    /**
     * Calculate the sample variance of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function sampleVariance(array $numbers): float;

    /**
     * Calculate the sample standard deviation of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function sampleStandardDeviation(array $numbers): float;

    /**
     * Calculate the coefficient of variation of an array of numbers.
     *
     * @param array $numbers
     * @return float
     */
    public function coefficientOfVariation(array $numbers): float;

    /**
     * Calculate the weighted mean of an array of numbers with corresponding weights.
     *
     * @param array $numbers
     * @param array $weights
     * @return float
     */
    public function weightedMean(array $numbers, array $weights): float;
}
