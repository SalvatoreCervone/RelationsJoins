<?php

namespace SalvatoreCervone\RelationsJoins;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ReturnJoin
{
    public static function getDataRelations()
    {
        $modelRelation = null;
        $relations = $this->getRelations();
        foreach ($relations as $key => $value) {
            $type = get_class($this->{$key}());
            $data = [];
            if ($type == HasMany::class) {
                $data = [
                    'nome' => $key,
                    'classe' => get_class($this->{$key}()->getRelated()),
                    'tipo' => $type,
                    'tablerelation' => $this->{$key}()->getRelated()->getTable(),
                    'foreignkey' => $this->{$key}()->getQualifiedForeignKeyName(),
                    'parentkey' => $this->{$key}()->getQualifiedParentKeyName(),
                ];
                $data['join'] = 'inner join '.$data['tablerelation'].' on '.$data['foreignkey'].'='.$data['parentkey'];
                $modelRelation[] = $data;
            } elseif ($type == BelongsToMany::class) {
                $data = [
                    'nome' => $key,
                    'classe' => get_class($this->{$key}()->getRelated()),
                    'tipo' => $type,
                    'tablepivot' => $this->{$key}()->getTable(),
                    'tablerelation' => $this->{$key}()->getRelated()->getTable(),
                    'parentkey' => $this->{$key}()->getQualifiedParentKeyName(),
                    'parentforeignkey' => $this->{$key}()->getQualifiedRelatedPivotKeyName(),
                    'relationkey' => $this->{$key}()->getQualifiedRelatedKeyName(),
                    'relationforeignkey' => $this->{$key}()->getQualifiedForeignPivotKeyName(),
                ];
                $data['join'] = 'inner join '.$data['tablepivot'].' on '.$data['parentforeignkey'].'='.$data['parentkey'].
                    ' inner join '.$data['tablerelation'].' on '.$data['relationkey'].'='.$data['relationforeignkey'];

                $modelRelation[] = $data;
            }
        }

        return $modelRelation;
    }
}
