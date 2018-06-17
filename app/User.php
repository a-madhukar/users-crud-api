<?php 

namespace App; 

use Mongo; 
use MongoDB\BSON\ObjectId; 


class User extends Model 
{

    protected $collection = "users"; 



    public static function persist($attributes)
    {
        $collection = Mongo::get()->usersdatabase->users; 


        $record = $collection->insertOne([
            "username" => isset($attributes['username']) ? $attributes['username'] : '', 
            "email" => isset($attributes['email']) ? $attributes['email'] : '', 
            "role" => isset($attributes['role']) ? $attributes['role'] : '', 
        ]); 

        return $record->getInsertedId();
    }




    public static function findAndUpdate($id, $attributes)
    {
        $collection = Mongo::get()->usersdatabase->users; 

        $attributes = [
            "username" => isset($attributes['username']) ? $attributes['username'] : '', 
            "email" => isset($attributes['email']) ? $attributes['email'] : '', 
            "role" => isset($attributes['role']) ? $attributes['role'] : '', 
        ]; 

        if(strlen($id) < 24) return null; 

        $filters = ["_id" => new ObjectId("$id")]; 


        $record = $collection->findOneAndReplace($filters, $attributes); 


        return $record; 

    }





    public static function all()
    {
        $collection = Mongo::get()->usersdatabase->users; 

        return $collection->find()->toArray();

    }





    public static function findById($id)
    {

        $collection = Mongo::get()->usersdatabase->users; 

        if(strlen($id) < 24) return null; 

        return $collection->findOne([
            "_id" => new ObjectId("$id"),  
        ]);
    }




    public static function delete($id)
    {
        $collection = Mongo::get()->usersdatabase->users; 

        if(strlen($id) < 24) return null; 

        return $collection->deleteOne(["_id" => new ObjectId("$id")]); 
    }


}