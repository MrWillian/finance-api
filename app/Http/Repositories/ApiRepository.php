<?php

namespace App\Http\Repositories;

use App\Traits\ApiResponser;
use App\Http\Repositories\Types\BaseRepository;

class ApiRepository extends BaseRepository
{
  use ApiResponser;
}
