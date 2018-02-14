<?php

function create($class, $attributes = [], int $times = null)
{
    return factory($class, $times)->create($attributes);
}

function make($class, $attributes = [], int $times = null)
{
    return factory($class, $times)->make($attributes);
}
