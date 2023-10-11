<?php
include_once "ApiController.php";
class ShopController extends ApiController
{

    protected function do_get()
    {
        global $_CONTEXT;
        $db = $this->get_db();
        $where = "";
        if (isset($_GET['grp']) && $_GET['grp'] != "all") {
            // if(is_numeric($_GET['grp']))
            // $where = "WHERE id_group = {$_GET['grp']}";
            $sql = "SELECT id FROM product_groups WHERE id = :grp OR url = :grp";
            try {
                $prep = $db->prepare($sql);
                $prep->bindParam(':grp', $_GET['grp']);
                $prep->execute();
                $row = $prep->fetch();
                // var_dump($row); exit;
            } catch (\Throwable $th) {
                $this->log_error("m: " . __METHOD__ . " | l: " . __LINE__ . " | error: " . $th->getMessage());
                $this->send_error(500);
            }
            if ($row == false) {
                $where = "WHERE NULL";    
            }
            else {
                $where = "WHERE id_group = {$row['id']}";
            }
        }
        $sql = "SELECT * FROM products {$where}";
        try {
            $ans = $db->query($sql);
            $products = $ans->fetchAll();
        } catch (\Throwable $th) {
            $this->log_error("m: " . __METHOD__ . " | l: " . __LINE__ . " | error: " . $th->getMessage());
            $this->send_error(500);
        }
        $sql = "SELECT * FROM product_groups";
        try {
            $ans = $db->query($sql);
            $product_groups = $ans->fetchAll();
        } catch (\Throwable $th) {
            $this->log_error("m: " . __METHOD__ . " | l: " . __LINE__ . " | error: " . $th->getMessage());
            $this->send_error(500);
        }
        $page = 'ShopView.php';
        include '_layout.php';
    }

}