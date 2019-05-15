<?php


namespace TaylorNetwork\RowColRenderer\Tests\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseTestModel extends Model
{
    public static $number;

    protected $guarded = [];

    public static function all($columns = ['*'])
    {
        $collection = collect();

        for ($i = 1; $i <= static::$number; $i++) {
            $collection->push(new static(['id' => $i]));
        }

        return $collection;
    }
}