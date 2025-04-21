<?php
namespace AlanRetubis\LogicEngine\Models;

use Illuminate\Database\Eloquent\Model;

class LogicRule extends Model
{
    protected $fillable = ['name', 'trigger', 'raw_script', 'enabled'];
}
