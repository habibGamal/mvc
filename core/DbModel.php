<?php

    namespace app\core;
    abstract class DbModel extends Model{
        abstract public function tableName(): string;
        abstract public function attributes(): array;
        abstract public function primaryKey(): string;
        public function save(){
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr)=>":$attr",$attributes);
            $statment = self::prepare("INSERT INTO $tableName (".implode(',',$attributes).") VALUES(".implode(',',$params).")");
            foreach($attributes as $attr){
                $statment->bindValue(":$attr",$this->{$attr});
            }
            $statment->execute();
            return true;
        }
        public static function findOne($where){
            // $where may be [email => habib@gmail.com , firstname => habib]
            $tableName = static::tableName();
            $attributes = array_keys($where);
            $query = implode('AND' ,array_map(fn($attr)=>"$attr = :$attr",$attributes));
            // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname 
            $statment = self::prepare("SELECT * FROM $tableName WHERE $query");
            foreach($where as $key => $value){
                $statment->bindValue(":$key" ,$value);
            }
            $statment->execute();
            return $statment->fetchObject(static::class);
        }
        public static function prepare($sql){
            return Application::$app->db->pdo->prepare($sql);
        }
    }