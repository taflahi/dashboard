<?php

namespace dashboard;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //

   	public function meta()
    {
        return $this->hasOne('dashboard\Meta');
    }
}
