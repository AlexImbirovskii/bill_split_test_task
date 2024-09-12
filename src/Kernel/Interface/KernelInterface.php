<?php

namespace App\Kernel\Interface;

interface KernelInterface
{
    public function loadEnv(): KernelInterface;

    public function handleRequest(): KernelInterface;
}