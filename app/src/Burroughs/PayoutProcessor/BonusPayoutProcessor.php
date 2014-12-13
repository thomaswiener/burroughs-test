<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 12/9/14
 * Time: 8:00 AM
 */

namespace Wienerio\Burroughs\PayoutProcessor;

/**
 * Class BonusPayoutProcessor
 * @package Wienerio\Burroughs\PayoutProcessor
 */
class BonusPayoutProcessor implements PayoutInterface
{
    /**
     * processor name
     */
    const NAME = 'bonus';

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
        $this->due = intval($config['due']);
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
        $year = $date->format('Y');
        $month = $date->format('m');
        $date->setDate($year, $month, $this->due);

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
