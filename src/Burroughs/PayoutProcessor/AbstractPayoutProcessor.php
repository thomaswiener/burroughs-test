<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 12/9/14
 * Time: 8:00 AM
 */

namespace Wienerio\Burroughs\PayoutProcessor;

/**
 * Class DefaultPayoutProcessor
 * @package Wienerio\Burroughs\PayoutProcessor
 */
abstract class AbstractPayoutProcessor
{
    private $name;

    /**
     * @var string
     */
    private $due;

    /**
     * @var array
     */
    private $allowedDays;

    /**
     * @var string
     */
    private $fallback;

    /**
     * Set the configuration
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->name = $config['name'];
        $this->due = $config['due'];
        $this->allowedDays = $config['allowed_days'];
        $this->fallback = $config['fallback'];
    }

    /**
     * Get the processed payout date of the process by a given initial date
     *
     * @param \DateTime $date
     *
     * @return \DateTime
     */
    abstract public function getPayoutDate(\DateTime $date);

    /**
     * Get the processor name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getAllowedDays()
    {
        return $this->allowedDays;
    }

    /**
     * @return string
     */
    public function getDue()
    {
        return $this->due;
    }

    /**
     * @return string
     */
    public function getFallback()
    {
        return $this->fallback;
    }


}