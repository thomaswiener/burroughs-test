<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 12/9/14
 * Time: 5:16 AM
 */

namespace Wienerio\Burroughs\PayoutProcessor;

interface PayoutInterface
{
    /**
     * Get the processor name
     *
     * @return string
     */
    public function getName();

    /**
     * Get the processed payout date of the process by a given initial date
     *
     * @param \DateTime $date
     *
     * @return \DateTime
     */
    public function getPayoutDate(\DateTime $date);
}
