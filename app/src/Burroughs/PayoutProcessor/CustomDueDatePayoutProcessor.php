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
class CustomDueDatePayoutProcessor extends DefaultPayoutProcessor implements PayoutInterface
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
        $year = $date->format('Y');
        $month = $date->format('m');
        $date->setDate($year, $month, $this->getDue());

        $currentWeekday = $date->format('w');

        if (in_array($currentWeekday, $this->getAllowedDays())) {
            return $date;
        }

        $date->modify($this->getFallback());

        return $date;
    }
}
