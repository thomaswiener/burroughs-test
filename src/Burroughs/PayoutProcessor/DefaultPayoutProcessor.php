<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 12/9/14
 * Time: 8:00 AM
 */

namespace Wienerio\Burroughs\PayoutProcessor;
use Monolog\Logger;

/**
 * Class DefaultPayoutProcessor
 * @package Wienerio\Burroughs\PayoutProcessor
 */
class DefaultPayoutProcessor extends AbstractPayoutProcessor implements PayoutInterface
{
    /**
     * Get the processed payout date of the process by a given initial date
     *
     * @param \DateTime $date
     *
     * @return \DateTime
     */
    public function getPayoutDate(\DateTime $date)
    {
        $date->modify($this->getDue());
        $currentWeekday = $date->format('w');

        if (in_array($currentWeekday, $this->getAllowedDays())) {
            return $date;
        }
        $dateBefore = clone $date;
        $date->modify($this->getFallback());

        $this->logDateModification($dateBefore, $date);

        return $date;
    }
}
