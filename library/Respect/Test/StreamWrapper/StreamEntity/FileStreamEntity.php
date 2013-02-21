<?php
namespace Respect\Test\StreamWrapper\StreamEntity;

class FileStreamEntity extends StreamEntity
{
    protected   $type  = 0100000,
                $perms = 0666;

    public function getSize()
    {
        return strlen($this->getData());
    }

}
