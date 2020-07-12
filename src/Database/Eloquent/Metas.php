<?php
/**
 * http://www.tanecn.com
 * 作者: Tanwen
 * 邮箱: 361657055@qq.com
 * 所在地: 广东广州
 * 时间: 2018/3/6 17:16
 */

namespace Tanwencn\Admin\Database\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Tanwencn\Admin\Database\Collection\RanksCollection;

class Metas extends Model
{
    public $timestamps = false;

    protected $touches = ['base'];

    protected $fillable = ['meta_key', 'meta_value'];

    public static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            if ($model->isDirty()) Cache::forget($model->base->getMetaCacheKey());
        });
    }

    public function base()
    {
        return $this->morphTo('target');
        //return $this->belongsTo(Str::before(get_class($this), 'Meta'), 'target_id');
    }

    public function newCollection(array $models = [])
    {
        return new RanksCollection($models);
    }
}