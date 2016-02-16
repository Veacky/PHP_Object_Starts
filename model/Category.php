<?php

class Category {

    protected $_idcategory;
    protected $_name;


    public function __construct($idcategory, $name) {
        $this->_idcategory = $idcategory;
        $this->_name = $name;
    }

    public function __get($fieldName) {
        $varName = "_".$fieldName;
        if (property_exists(get_class($this), $varName))
            return $this->$varName;
        else
            throw new Exception("Unknown variable: ".$fieldName);
    }


    public function __set($fieldName, $value) {
        $varName = "_".$fieldName;
        if ($value != null) {
            if (property_exists(get_class($this), $varName)) {
                $this->$varName = $value;
                $class = get_class($this);
                $table = strtolower($class);
                $id = "_id".$fieldName;
                if (isset($value->$id)) {
                    $st = db()->prepare("update public.$table set id$fieldName=:val where id$table=:id");
                    $id = substr($id, 1);
                    $st->bindValue(":val", $value->$id);
                } else {
                    $st = db()->prepare("update public.$table set $fieldName=:val where id$table=:id");
                    $st->bindValue(":val", $value);
                }
                $id = "id".$table;
                $st->bindValue(":id", $this->$id);
                $st->execute();
            } else
                throw new Exception("Unknown variable: ".$fieldName);
        }
    }


    public static function findAll() {
        $class = get_called_class();
        $table = strtolower($class);
        $st = db()->prepare("select * from $table");
        $st->execute();
        $list = array();
        while($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new $class($row["id".$table], $row["name"]);
        }
        return $list;
    }

    public static function LoadFromID($id){
        $st = db()->prepare("SELECT * FROM category where idcategory=".$id);
        $st->execute();
        while($row = $st->fetch(PDO::FETCH_ASSOC)){
            $category = new Category($row["idcategory"], $row["name"]);
        }
        return $category;
    }

}
