<?php
use Symfony\Component\Console\Helper\Helper;

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 29/05/2016
 * Time: 12:15 AM
 */
class HelperTest extends PHPUnit_Framework_TestCase
{
    public function testSum()
    {
        $data = [1,2,3];
        $result = 0;
        foreach($data as $number){
            $result += $number;
        }
        $this->assertEquals(6, $result);
    }
}