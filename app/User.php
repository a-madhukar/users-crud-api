<?php 

namespace App; 

use Mongo; 
use MongoDB\BSON\ObjectId; 


class User 
{

    use Model; 


    protected $collection = "users"; 



    public static function persist($attributes, $userId = null)
    {

        $attributes = [
            "username" => isset($attributes['username']) ? $attributes['username'] : '', 
            "email" => isset($attributes['email']) ? $attributes['email'] : '', 
            "role" => isset($attributes['role']) ? $attributes['role'] : '', 
        ]; 


        return call_user_func_array(
            [new static, is_null($userId) ? "insertAndGetId" : "findAndUpdate"], 
            func_get_args()
        ); 
        
    }




    public static function insertAndGetId($attributes, $id = null)
    {
        $record = self::collection()->insertOne($attributes); 

        return self::findById($record->getInsertedId());

    }




    public static function findAndUpdate($attributes, $id)
    {

        if(strlen($id) < 24) return null; 

        $filters = ["_id" => new ObjectId("$id")]; 

        $record = self::collection()->findOneAndReplace($filters, $attributes); 

        return self::findById($id); 

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
        ->deleteOne(["_id" => new ObjectId($id)]); 
    }


}