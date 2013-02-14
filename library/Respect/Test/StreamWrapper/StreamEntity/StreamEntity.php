<?php
namespace Respect\Test\StreamWrapper\StreamEntity;

use Exception;

class StreamEntity
{
    protected $resource,
        $path,
        $data,
        $open  = false,
        $mode  = 'w+b',
        $uri   = 'data:text/plain;base64,';

    public function openResource()
    {
        $this->setResource(fopen($this->getDataUri(),$this->getMode()));
        $this->setOpen(!is_null($this->getResource()));
    }
    public function getStat($stat=null)
    {
        return $stat;
    }
    public function closeResource()
    {
        if ($this->isOpen() && fclose($this->getResource()))
            $this->setResource(null);
        else
            throw new Exception("Unable to release the ".get_called_class()." resource.");
        $this->setOpen(!is_null($this->getResource()));
    }
    public function setOpen($open)
    {
        $this->open = $open;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
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
}
