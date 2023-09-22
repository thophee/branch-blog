<?php

namespace App;
class RouteParameters
{
    public array $Query;

    public array $Uri;
    public function __construct($Query, $Uri) {
        $this->Query = $Query;
        $this->Uri = $Uri;
    }
}