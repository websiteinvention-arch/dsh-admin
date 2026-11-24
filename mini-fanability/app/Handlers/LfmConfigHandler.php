<?php

namespace App\Handlers;

class LfmConfigHandler
{
    public function userField()
    {

        return session('website_id');
    }
}