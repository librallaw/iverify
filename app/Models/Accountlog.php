<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accountlog extends Model
{
    //

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s.u';
    }


}
