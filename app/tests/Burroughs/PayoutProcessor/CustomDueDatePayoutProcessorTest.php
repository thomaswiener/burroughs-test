<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 12/9/14
 * Time: 8:00 AM
 */

namespace Wienerio\Tests\Burroughs\PayoutCalculator;

use Wienerio\Burroughs\PayoutProcessor\CustomDueDatePayoutProcessor;

/**
 * Class Driver
 *
 * @author Thomas Wiener <wiener.thomas@googlemail.com>
 */
class CustomDueDatePayoutProcessorTest extends \PHPUnit_Framework_TestCase
{
    protected $payoutProcessor;

    public function setUp()
    {
        parent::setUp();

        $config = [
            'name'          => 'bonus',
            'due'           => '15',
            'allowed_days'  => [1, 2, 3, 4, 5],
            'fallback'      => 'next wednesday'
        ];

        $this->payoutProcessor = new CustomDueDatePayoutProcessor($config);
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->payoutProcessor = null;
    }

    public function testGetName()
    {
        $this->assertEquals($this->payoutProcessor->getName(), 'bonus');
    }

    public function testDayOfMonthOnSaturday()
    {
        $date = new \DateTime();
        $date->setDate(2014, 2, 1);
        $dateCalculated = $this->payoutProcessor->getPayoutDate($date);

        $this->assertEquals(
            $dateCalculated->format('Y-m-d'),
            '2014-02-19'
        );
    }

    public function testDayOfMonthOnSunday()
    {
        $date = new \DateTime();
        $date->setDate(2014, 6, 1);
        $dateCalculated = $this->payoutProcessor->getPayoutDate($date);

        $this->assertEquals(
            $dateCalculated->format('Y-m-d'),
            '2014-06-18'
        );
    }

    public function testDayOfMonthOnFriday()
    {
        $date = new \DateTime();
        $date->setDate(2014, 8, 1);
        $dateCalculated = $this->payoutProcessor->getPayoutDate($date);

        $this->assertEquals(
            $dateCalculated->format('Y-m-d'),
            '2014-08-15'
        );
    }

    public function testDayOfMonthOnMonday()
    {
        $date = new \DateTime();
        $date->setDate(2014, 9, 1);
        $dateCalculated = $this->payoutProcessor->getPayoutDate($date);

        $this->assertEquals(
            $dateCalculated->format('Y-m-d'),
            '2014-09-15'
        );
    }
}
