<?php
namespace Respect\Test\StreamWrapper\StreamEntity;

class DirectoryStreamEntity extends StreamEntity
{
    protected   $type  = 0040000,
                $perms = 0777;

    public function getSize()
    {
        return 0;
    }

}
