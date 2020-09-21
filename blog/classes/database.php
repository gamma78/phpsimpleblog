<?php
class database{

    private $_db;

    public function __construct($host='localhost',$dbname='',$user='root',$pass='')
    {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $this->_db = new PDO($dsn , $user , $pass);
    }

    //select all user from user_tbl
    public function selectAll(){
        $query = 'SELECT * FROM user_tbl';
        $stmt = $this->_db->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($users as $user){
            echo $user->username."<br>";
        }
    }

    //select user by id
    public function selectUserbyId($id){

        $query = 'SELECT * FROM user_tbl WHERE id = ?';
        $stmt = $this->_db->prepare($query);
        $stmt->execute([$id]);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        if ($stmt->rowCount()){
            return $users;
        }

    }

    //function for update user by id
    public function updateUserbyId($id , $password , $name){
        try {
            $query = 'UPDATE user_tbl SET password = ? , name = ? WHERE id = ?';
            $stmt = $this->_db->prepare($query);
            $stmt->execute([$password , $name , $id]);
            header("Location:profile.php");

        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    //function for login user if exists
    public function checkuser($username , $password){
        $query = 'SELECT * FROM user_tbl WHERE username = ? AND password = ?';
        $stmt = $this->_db->prepare($query);
        $stmt->execute([$username,$password]);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        if ($stmt->rowCount()){
            foreach ($users as $user){
                $this->set_session($user->name , $user->id);
            }
        }else{
            header("Location:login.php?errorlogin");
        }
    }

    //set session for having name and id of user
    public function set_session($name , $id){
        $_SESSION['name']=$name;
        $_SESSION['id']=$id;
        header("Location:index.php");
    }

    //unset or delete session of user (name , id)
    public function unset_session($name){
        unset($_SESSION['name']);
        header("Location:index.php");
    }

    //add blog to blog_tbl
    public function add_blog($title , $desc , $author){
        $date = date("H");
        $query = "INSERT INTO blog_tbl (title, description, author) VALUES (? , ? , ?)";
        $stmt = $this->_db->prepare($query);
        $stmt->execute([$title,$desc,$author]);
        header("Location:index.php");
        exit();
    }

    public function selectAllBlog(){
        $query = 'SELECT * FROM blog_tbl';
        $stmt = $this->_db->prepare($query);
        $stmt->execute();
        $blogs = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $blogs;
    }

    public function selectBlogbyId($id){
        $query = 'SELECT * FROM blog_tbl WHERE id = ?';
        $stmt = $this->_db->prepare($query);
        $stmt->execute([$id]);
        $blogs = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $blogs;
    }

    //update blog by id
    public function updateBlogbyId($id , $title , $desc , $author){

            $query = 'UPDATE `blog_tbl` SET `title`=:title,`description`=:description,`updated_at`=:updated_at,`author`=:author WHERE id = :id';

            $stmt = $this->_db->prepare($query);

            $update = date("Y-m-d h:i:s");

            $stmt->bindParam(':title',$title);

            $stmt->bindParam(':description',$desc);

            $stmt->bindParam(':updated_at',$update);

            $stmt->bindParam(':author',$author);

            $stmt->bindParam(':id',$id);

            $stmt->execute();

            header("Location:index.php");
    }

    public function deleteBlogbyId($id){
        $query = 'DELETE FROM `blog_tbl` WHERE id=:id';
        $stmt = $this->_db->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        header("Location:index.php?deletesuccess");
    }


}