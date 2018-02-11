<?php 

function ninja ($value = null, $die = 1)
{
    echo "Debug <br><pre>";
    echo print_r($value);
    echo "</pre>";
    if ($die) {die;}
}

