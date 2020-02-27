<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Follow extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'followings';
}
