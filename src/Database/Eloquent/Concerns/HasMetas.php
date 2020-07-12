<?php
/**
 * http://www.tanecn.com
 * 作者: Tanwen
 * 邮箱: 361657055@qq.com
 * 所在地: 广东广州
 * 时间: 2018/3/14 16:59
 */

namespace Tanwencn\Admin\Database\Eloquent\Concerns;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Tanwencn\Admin\Database\Eloquent\Metas;

trait HasMetas
{
    protected static $hasMetasClass;

    protected $_metas;

    public function initializeHasMetas()
    {
        $this->fillable = array_merge($this->fillable, ['metas']);
    }

    public static function bootHasMetas()
    {
        //static::$hasMetasClass = file_exists(static::class.'Meta')?static::class.'Meta':UserMeta::class;
        static::$hasMetasClass = Metas::class;
        static::deleting(function ($model) {
            if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {
                return;
            }

            $model->metas()->delete();
        });
    }

    public function getMetaCacheKey()
    {
        return "meta" . md5($this->getMorphClass . $this->id, 16);
    }

    public function getMetasAttribute()
    {
        return Cache::rememberForever($this->getMetaCacheKey(), function () {
            return $this->metas()->get()->getRanks();
        });
    }

    public function metas()
    {
        return $this->morphMany(static::$hasMetasClass, 'target');
        //return $this->hasMany(static::$hasMetasClass, 'target_id');
    }

    public function setMetasAttribute($value)
    {
        $data = array_filter($value);
        foreach ($data as $key => $val) {
            if (!isset($val['meta_key']))
                $val = ['meta_key' => $key, 'meta_value' => $val];

            static::saved(function ($model) use ($val) {
                $model->metas()->firstOrNew(['meta_key' => $val['meta_key']])->fill($val)->save();
            });
        }
    }

    public function scopeOrderByMeta(Builder $query, $field)
    {
        $key = "{$this->getTable()}.{$this->getKeyName()}";
        $join_table = $this->metas()->getModel()->getTable();
        return $query->select($this->getTable() . '.*')->leftJoin($join_table, function ($join) use ($join_table, $key, $field) {
            $join->on($key, '=', "{$join_table}.target_id")
                ->where("{$join_table}.meta_key", '=', $field);
        })->orderBy("{$join_table}.meta_value");
    }
}