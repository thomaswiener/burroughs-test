<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 12/13/14
 * Time: 3:40 PM
 */
namespace Wienerio\Burroughs\Data;

/**
 * The DTP for the processed data
 *
 * Class PayoutData
 * @package Wienerio\Burroughs\Data
 */
class PayoutData implements PayoutDataInterface
{
    /**
     * @var
     */
    private $date;

    /**
     * @var
     */
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    /**
     * Get Date
     *
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set Date
     *
     * @param mixed $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get Items
     *
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set Items
     *
     * @param mixed $items
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Add single item to items
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function addItem($key, $value)
    {
        $this->items[$key] = $value;

        return $this;
    }

    /**
     * Return data as array
     *
     * @return mixed
     */
    public function getDataAsArray()
    {
        return $this->items;
    }

    /**
     * Return header of data as array
     *
     * @return mixed
     */
    public function getHeaderAsArray()
    {
        return array_keys($this->items);
    }


} 