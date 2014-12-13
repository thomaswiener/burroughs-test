<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 12/9/14
 * Time: 8:00 AM
 */

namespace Wienerio\Burroughs\PayoutProcessor;

/**
 * Class SalaryPayoutProcessor
 * @package Wienerio\Burroughs\PayoutProcessor
 */
class SalaryPayoutProcessor implements PayoutInterface
{
    /**
     * processor name
     */
    const NAME = 'salary';

    /**
     * @var string
     */
    protected $due;

    /**
     * @var array
     */
    protected $allowedDays;

    /**
     * @var string
     */
    protected $fallback;

    /**
     * Set the configuration
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
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
    public function getPayoutDate(\DateTime $date)
    {
        $date->modify($this->due);
        $currentWeekday = $date->format('w');

        if (in_array($currentWeekday, $this->allowedDays)) {
            return $date;
        }

        $date->modify($this->fallback);

        return $date;
    }

    /**
     * Get the processor name
     *
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}