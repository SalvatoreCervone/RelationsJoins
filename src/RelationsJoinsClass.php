<?php

namespace SalvatoreCervone\RelationsJoins;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RelationsJoinsClass
{
    public static function init(Model $model, array $relation)
    {
        $model->load($relation);
        $mapModelType = self::getDataRelations($model);

        return $mapModelType;
    }

    public static function getDataRelations($model)
    {
        $modelRelation = null;
        $relations = $model->getRelations();
        foreach ($relations as $key => $value) {
            $type = get_class($model->{$key}());
            $data = [];
            if ($type == HasMany::class) {
                $data = [
                    'nome' => $key,
                    'classe' => get_class($model->{$key}()->getRelated()),
                    'tipo' => $type,
                    'tablerelation' => $model->{$key}()->getRelated()->getTable(),
                    'foreignkey' => $model->{$key}()->getQualifiedForeignKeyName(),
                    'parentkey' => $model->{$key}()->getQualifiedParentKeyName(),
                ];
                $data['join'] = 'inner join '.$data['tablerelation'].' on '.$data['foreignkey'].'='.$data['parentkey'];
                $modelRelation[] = $data;
            } elseif ($type == BelongsToMany::class) {
                $data = [
                    'nome' => $key,
                    'classe' => get_class($model->{$key}()->getRelated()),
                    'tipo' => $type,
                    'tablepivot' => $model->{$key}()->getTable(),
                    'tablerelation' => $model->{$key}()->getRelated()->getTable(),
                    'parentkey' => $model->{$key}()->getQualifiedParentKeyName(),
                    'parentforeignkey' => $model->{$key}()->getQualifiedRelatedPivotKeyName(),
                    'relationkey' => $model->{$key}()->getQualifiedRelatedKeyName(),
                    'relationforeignkey' => $model->{$key}()->getQualifiedForeignPivotKeyName(),
                ];
                $data['join'] = 'inner join '.$data['tablepivot'].' on '.$data['parentforeignkey'].'='.$data['parentkey'].
                    ' inner join '.$data['tablerelation'].' on '.$data['relationkey'].'='.$data['relationforeignkey'];

                $modelRelation[] = $data;
            }
        }

        return $modelRelation;
    }
}
