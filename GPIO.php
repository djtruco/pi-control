<?php

include 'GPIOException.php';

class GPIO {

    function export(int $port):void {
        exec("echo $port | sudo tee -a /sys/class/gpio/export");
    }

    function unexport(int $port):void {
        exec("echo $port | sudo tee -a /sys/class/gpio/unexport");
    }

    function setDirection(int $port, string $dir):void {
        if ($dir != 'in' && $dir != 'out') {
            throw new GPIOException("Direction must be 'in' or 'out'");
        }
        exec("echo $dir | sudo tee -a /sys/class/gpio/gpio{$port}/direction");
    }

    function setValue(int $port, int $value):void {
        if ($value != 0 && $value != 1) {
            throw new GPIOException("Value must be 0 or 1");
        }
        exec("echo $value | sudo tee -a /sys/class/gpio/gpio{$port}/value");
    }

    function getValue(int $port):string {
        return exec("sudo cat /sys/class/gpio/gpio{$port}/value");
    }
}
