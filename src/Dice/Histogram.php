<?php

namespace Drabantor\Dice;

/**
 * Generating histogramgram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min;
    private $max;

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Inject the object to use as base for the histogramgram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }

    /**
     * Return a string with a textual representation of the histogramgram.
     *
     * @return string representing the histogramgram.
     */
    public function getAsText()
    {
        $startWith = $this->min ?? 1;
        $endWith = $this->max ?? 6;
        $histogram = [];

        $mapping = array_count_values($this->serie);

        for ($i = $startWith; $i <= $endWith; $i++) {
            if (array_key_exists($i, $mapping)) {
                $histogram[] = $i . ": " . str_repeat("*", $mapping[$i]);
            } else if ($this->min !== null && $this->max !== null) {
                $histogram[] = $i . ": ";
            }
        }
        return $histogram;
    }
}
