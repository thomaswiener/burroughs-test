<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 12/13/14
 * Time: 3:51 PM
 */
namespace Wienerio\Burroughs\Writer;

/**
 * Class CsvWriter
 * @package Wienerio\Burroughs\Writer
 */
class CsvWriter
{
    /**
     * @var
     */
    private $filename;

    private $fullFilePath;

    /**
     * @var resource
     */
    private $fileHandle;

    /**
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->fullFilePath = __DIR__ . '/../../../' . $filename;

        //clean up (remove file if exists)
        if (file_exists($this->fullFilePath)) {
            unset($fullFilePath);
        }
        $this->fileHandle = fopen($this->fullFilePath, 'w');
    }

    /**
     * Append data to the file
     *
     * @param $data
     */
    public function appendData($data)
    {
        fputcsv($this->fileHandle, $data);
    }
}
