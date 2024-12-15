<?php

namespace common\repositories;

class AbstractRepository {

    protected static string $entityClass;

    public static function findById(int $id) {
        return static::$entityClass::findOne($id);
    }

    public static function find(array $condition = []) {
        if ($condition) {
            return static::$entityClass::find()->where($condition);
        }
        return static::$entityClass::find()->all();
    }

}