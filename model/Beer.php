<?php

class Beer {

    protected $_idbeer;
    protected $_name;
    protected $_idcategory;


    public function __construct($idbeer, $name, $idcategory) {
        $this->_idbeer = $idbeer;
        $this->_name = $name;
        $this->_idcategory = $idcategory;
    }

    public function __get($fieldName) {
        $varName = "_".$fieldName;
        if (isset($this->$varName))
            return $this->$varName;
        else
            throw new Exception("Unknown variable");
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
            $list[] = new $class($row["id".$table], $row["name"], Category::LoadFromID($row["idcategory"]));
        }
        return $list;
    }

    public function findByID($id){
        $class = get_called_class();
        $table = strtolower($class);
        $st = db()->prepare("select * from $table where id$table = $id");
        $st->execute();
        while($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $beer = new $class($row["id".$table], $row["name"], Category::LoadFromID($row["idcategory"]));
        }
        return $beer;
    }

    public function add($name, $category){
        $st = db()->prepare("insert into beer (name, idcategory) values('".$name."','".$category."')");
        $st->execute();
    }
    public function modify($id, $name, $category){
        echo "classe";
        $st = db()->prepare("update beer set name ='".$name."', idcategory ='".$category."' where idbeer = ".$id);
        $st->execute();
    }
    public function delete($id){
        $st = db()->prepare("delete from beer where idbeer = $id");
        $st->execute();
    }
}
