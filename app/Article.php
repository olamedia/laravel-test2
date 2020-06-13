<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

final class Article extends Model
{
    protected $fillable = ['title', 'text'];
}
