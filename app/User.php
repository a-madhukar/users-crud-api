<?php 

namespace App; 

use Mongo; 
use MongoDB\BSON\ObjectId; 


class User 
{

    use Model; 

    protected $collection = "users"; 



    public static function persist($attributes)
    {

        $record = self::collection()->insertOne([
            "username" => isset($attributes['username']) ? $attributes['username'] : '', 
            "email" => isset($attributes['email']) ? $attributes['email'] : '', 
            "role" => isset($attributes['role']) ? $attributes['role'] : '', 
        ]); 

        return $record->getInsertedId();
    }




    public static function findAndUpdate($id, $attributes)
    {

        $attributes = [
            "username" => isset($attributes['username']) ? $attributes['username'] : '', 
            "email" => isset($attributes['email']) ? $attributes['email'] : '', 
            "role" => isset($attributes['role']) ? $attributes['role'] : '', 
        ]; 

        if(strlen($id) < 24) return null; 

        $filters = ["_id" => new ObjectId("$id")]; 


        $record = self::collection()->findOneAndReplace($filters, $attributes); 


        return $record; 

    }





    public static function all()
    {
        return self::collection()->find()->toArray();
    }





    public static function findById($id)
    {
        if(strlen($id) < 24) return null; 

        return self::collection()->findOne([
            "_id" => new ObjectId("$id"),  
        ]);
    }




    public static function delete($id)
    {
        if(strlen($id) < 24) return null; 

        return self::collection()
        ->deleteOne(["_id" => new ObjectId("$id")]); 
    }


}