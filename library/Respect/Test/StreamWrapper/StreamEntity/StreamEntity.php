<?php
namespace Respect\Test\StreamWrapper\StreamEntity;

use Exception;

abstract class StreamEntity
{
    protected   $resource,
                $type,
                $path,
                $data,
                $atime,
                $mtime,
                $ctime,
                $size  = 0,
                $perms = 0000,
                $umask = 0022,
                $open  = false,
                $mode  = 'w+b',
                $uri   = 'data:text/plain;base64,';

    abstract public function getSize();

    public function __construct()
    {
        $time = time();
        $this->setAtime($time);
        $this->setCtime($time);
        $this->setMtime($time);
    }

    public function openResource()
    {
        $this->setResource(fopen($this->getDataUri(), $this->getMode()));
        $this->setOpen(is_resource($this->getResource()));
    }

    public function getStat()
    {
        $stat = array('dev'     => 0,
                      'ino'     => 0,
                      'mode'    => $this->getType() | $this->getPermissions(),
                      'nlink'   => 0,
                      'uid'     => $this->getUid(),
                      'gid'     => $this->getGid(),
                      'rdev'    => 0,
                      'size'    => $this->getSize(),
                      'atime'   => $this->getAtime(),
                      'mtime'   => $this->getMtime(),
                      'ctime'   => $this->getCtime(),
                      'blksize' => -1,
                      'blocks'  => -1
        );
        return array_merge(array_values($stat), $stat);
    }

    public function closeResource()
    {
        if ($this->isOpen() && fclose($this->getResource()))
            $this->setResource(null);
        else
            throw new Exception("Unable to release the ".get_called_class()." resource.");
        $this->setOpen(is_resource($this->getResource()));
    }

    public function setOpen($open)
    {
        $this->open = $open;
    }

    public function setMode($mode)
    {
        $this->mode = $mode ?: 'w+b';
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function isOpen()
    {
        return $this->open;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getDataEncoded()
    {
        return base64_encode($this->getData());
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function getDataUri()
    {
        return $this->getUri() . $this->getDataEncoded();
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setPath($path)
    {
        $path = rtrim($path, DIRECTORY_SEPARATOR);
        if ($path && $path{0} != DIRECTORY_SEPARATOR)
            if ($path{0} == '~' && array_key_exists('HOME',$_SERVER))
                $this->path = str_replace('~', $_SERVER['HOME'], $path);
            else
                $this->path = getcwd().DIRECTORY_SEPARATOR.$path;
        else
            $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getPermissions()
    {
        return $this->getPerms() & ~$this->getUmask();
    }

    public function setPerms($perms)
    {
        $this->perms = $perms;
    }

    public function getPerms()
    {
        return $this->perms;
    }

    public function setUmask($umask)
    {
        $this->umask = $umask;
    }

    public function getUmask()
    {
        return $this->umask;
    }

    public function setAtime($atime)
    {
        $this->atime = $atime;
    }

    public function getAtime()
    {
        return $this->atime;
    }

    public function setCtime($ctime)
    {
        $this->ctime = $ctime;
    }

    public function getCtime()
    {
        return $this->ctime;
    }

    public function setMtime($mtime)
    {
        $this->mtime = $mtime;
    }

    public function getMtime()
    {
        return $this->mtime;
    }

    public function getUid() {
        return function_exists('posix_getuid') ? posix_getuid() : getmyuid();
    }

    public function getGid() {
        return function_exists('posix_getgid') ? posix_getgid() : getmygid();
    }
}
