<?php
session_start();
class  dataBase 
{
    
    public 
    function connect($db=""){
        if($_SERVER['HTTP_HOST']=='pondacams.com'){
            $conn = new mysqli('localhost','root','','BitcubeEval');
            return $conn;
        }else{
            $conn = new mysqli('localhost','root','','BitcubeEval');
            return $conn;
        }
        
    }
    public
    function insData($table,$data){              
        $columns = implode("`,`",array_keys($data));
       // print_r($columns);die;
        $values  = implode("','",array_values($data));
        //echo "<pre>";
        //print_r($values);die;
        $sql = "INSERT INTO `$table` (`$columns`) VALUES ('$values')";
        //print_r($sql);die;
        $conn = $this->connect();
        $res = $conn->query($sql);
        $id = $conn->insert_id;
        return $id;       
    }
   
    public 
    function getRow($table,$param=[]){
        $where = "";
        $return = [];
        if(!empty($param)){
            $count = 0;
            foreach($param as $key => $value){
                if($count == 0 )
                {
                    $where ="WHERE $key='$value'";
                }
                else
                {
                    $where = $where." AND $key='$value'";
                }
                $count += 1;
            }
        }
        $sql = "SELECT *FROM $table $where";
       // print_r($sql);  
        $conn = $this->connect();
        $res = $conn->query($sql);
        while($row = $res->fetch_assoc()){
            $return[]= $row;
        }
        return $return;
    }
    public function deleteRow($table,$param=[]){
        $where = "";
        if(!empty($param)){
            foreach($param as $key => $value){
                $where ="WHERE $key='$value'";
            }
        }
        $sql = "DELETE FROM $table $where";
       // print_r($sql);  
        $conn = $this->connect();
        $res = $conn->query($sql);
    }
    public function updateData($table,$data,$param=[]){
        $where = "";
        if(!empty($param)){
            foreach($param as $key => $value){
                $where ="WHERE $key='$value'";
            }
        }
        $z = "";
        $i=0;
        foreach($data as $key=>$value ){
            if($i==0)
            $z.=  $key. " = '" .$value."'";
            else
            $z.=  ", ".$key. " = '" .$value."'";
            $i++;
        }
       // echo $z;die;
        $sql = "UPDATE $table SET $z $where"; 
    
        $conn = $this->connect();
        $res = $conn->query($sql);
        return true;

    }
}

$conn = new dataBase;
$conn -> connect();
$usernameErr  = $passwordErr = "";

?>