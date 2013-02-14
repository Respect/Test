<?php
namespace Respect\Test\StreamWrapper\StreamEntity;

class DirectoryStreamEntity extends StreamEntity
{
    public function getStat($stat=null)
    {
        if (($stat['mode'] & 0170000) == 32768)
            $stat['mode'] -= 16384;
        $stat['size'] = 0;
        return $stat;
    }
}
