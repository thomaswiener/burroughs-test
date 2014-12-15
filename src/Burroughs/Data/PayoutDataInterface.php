<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 12/13/14
 * Time: 3:49 PM
 */

namespace Wienerio\Burroughs\Data;

/**
 * Interface for DTOs of PayoutDatas
 *
 * Interface PayoutDataInterface
 * @package Wienerio\Burroughs\Data
 */
interface PayoutDataInterface
{
    /**
     * Return data as array
     *
     * @return mixed
     */
    public function getDataAsArray();

    /**
     * Return header of data as array
     *
     * @return mixed
     */
    public function getHeaderAsArray();
}
