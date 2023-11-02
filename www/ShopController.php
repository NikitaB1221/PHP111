<?php
include_once "ApiController.php";
class ShopController extends ApiController
{

	
	protected function do_get()
	{
		global $_CONTEXT;
		$per_page = 4; // кількість даних на одній сторінці

		$db = $this->get_db();
		$where = "";
		if (isset($_GET['grp']) && $_GET['grp'] != "all") {
			$sql = "SELECT id FROM product_groups WHERE id = :grp OR url = :grp";
			try {
				$prep = $db->prepare($sql);
				$prep->bindParam(':grp', $_GET['grp']);
				$prep->execute();
				$row = $prep->fetch();
				// var_dump( $row ) ; exit ;
			} catch (PDOException $ex) {
				$this->log_error(__METHOD__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
				$this->send_error(500);
			}
			if ($row === false) {
				$where = "WHERE NULL";
			} else {
				$where = "WHERE id_group = {$row['id']}";
			}


		}
		if (isset($_GET['min-price']) && is_numeric($_GET['min-price'])) {
			$cond = " price >= " . $_GET['min-price'];
			if ($where == "") {
				$where = "WHERE {$cond}";
			} else {
				$where .= " AND {$cond}";
			}
		}
		if (isset($_GET['max-price']) && is_numeric($_GET['max-price'])) {
			$cond = " price <= " . $_GET['max-price'];
			if ($where == "") {
				$where = "WHERE {$cond}";
			} else {
				$where .= " AND {$cond}";
			}
		}

		if ($_CONTEXT['admin_mode'] == false) {
			if ($where == "") {
				$where = " WHERE delete_dt IS NULL ";
			} else {
				$where .= " AND WHERE delete_dt IS NULL ";
			}
		}
		// Особливість пагінації - запит на вибірку не містить даних про загальний
		// розмір даних. Для їх одержання потрібен додатковий запит, але з тими ж
		// умовами (фільтрами), що й основний запит
		$sql = "SELECT COUNT(*) FROM products {$where}";
		try {
			$cnt = $db->query($sql)->fetch(PDO::FETCH_NUM)[0];
		} catch (PDOException $ex) {
			$this->log_error(__METHOD__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
			$this->send_error(500);
		}
		// $cnt - загальна кількість по вибірці, розраховуємо кількість сторінок
		// 8(2) 9(3) 10(3) 11(3) 12(3) 13(4)
		$last_page = ceil($cnt / $per_page);
		// визначаємо поточну сторінку
		$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		if ($current_page <= 0)
			$current_page = 1;
		if ($current_page > $last_page)
			$current_page = $last_page;
		// визначаємо $skip - кількість пропусків у вибірці для даної сторінки
		// 1(0x4), 2(1x4), 3(2x4)
		$skip = ($current_page - 1) * $per_page;

		// $sql = "SELECT * FROM products {$where} LIMIT {$skip}, {$per_page}";

		$sql = "SELECT
            p.*,
            pa.title AS action_title,
            pa.description AS action_description,
            pa.discount
        FROM
            products p
            LEFT JOIN product_actions pa ON p.id_action = pa.id
        {$where}
        LIMIT {$skip}, {$per_page}";

		try {
			$ans = $db->query($sql);
			$products = $ans->fetchAll();
		} catch (PDOException $ex) {
			$this->log_error(__METHOD__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
			$this->send_error(500);
		}

		$sql = "SELECT * FROM product_groups";
		try {
			$ans = $db->query($sql);
			$product_groups = $ans->fetchAll();
		} catch (PDOException $ex) {
			$this->log_error(__METHOD__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
			$this->send_error(500);
		}

		$sql = "SELECT * FROM product_actions";
		try {
			$ans = $db->query($sql);
			$product_actions = $ans->fetchAll();
		} catch (PDOException $ex) {
			$this->log_error(__METHOD__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
			$this->send_error(500);
		}

		if (!empty($_GET['admin-edit'])) {
			$sql = "SELECT * FROM products WHERE id = ?";
			try {
				$prep = $db->prepare($sql);
				$prep->execute([$_GET['admin-edit']]);
				$edit_product = $prep->fetch();
			} catch (\Throwable $th) {
				//throw $th;
			}
		}

		$page = 'ShopView.php';
		include '_layout.php';
	}

	protected function do_post()
	{
		$db = $this->get_db();
		//echo '<pre>'; print_r($_POST); print_r($_FILES);exit;
		if (isset($_POST['edit-id'])) {
			$this->edit_product();
		} else {
			$this->add_product($db);
		}
	}
	private function add_product($db)
	{
		if ($_FILES['avatar']['error'] == 0 & $_FILES['avatar']['size'] != 0) {
			$ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
			$avatar = uniqid() . ".$ext";
			move_uploaded_file($_FILES["avatar"]["tmp_name"], "./img/$avatar");
		} else {
			$avatar = null;
		}

		if (!empty($_POST["action"]))
			$action_id = $_POST["action"];
		else
			$action_id = null;

		if (!empty($_POST["description"]))
			$description = $_POST["description"];
		else
			$description = null;

		$sql = "INSERT INTO products (id,title, description, id_group, avatar, price, id_action) 
        VALUES(UUID_SHORT(),?,?,?,?,?,?)";
		try {
			$prep = $db->prepare($sql);
			$prep->execute([
				$_POST['title'],
				$description,
				$_POST['group'],
				$avatar,
				$_POST['price'],
				$action_id,
			]);
			http_response_code(201);

			// echo 'add ok';

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			$this->log_error(__METHOD__ . "#" . __LINE__ . $ex->getMessage() . "{$sql}");
			$this->send_error(500);
		}
	}

	private function edit_product()
	{
		$sql = "UPDATE products SET ";
		$need_comma = false;

		if ($_FILES['avatar']['error'] == 0 && $_FILES['avatar']['size'] != 0) {
			$ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
			$avatar = uniqid() . ".$ext";
			move_uploaded_file(
				$_FILES['avatar']['tmp_name'],
				"./img/$avatar"
			);
			$sql .= " avatar='$avatar' ";
			$need_comma = true;
		}

		if (!empty($_POST['title'])) {
			if ($need_comma)
				$sql .= ',';
			$sql .= " title='{$_POST['title']}' ";
			$need_comma = true;
		}
		if (!empty($_POST['description'])) {
			if ($need_comma)
				$sql .= ',';
			$sql .= " description='{$_POST['description']}' ";
			$need_comma = true;
		}
		if (!empty($_POST['group'])) {
			if ($need_comma)
				$sql .= ',';
			$sql .= " id_group='{$_POST['group']}' ";
			$need_comma = true;
		}
		if (!empty($_POST['price'])) {
			if ($need_comma)
				$sql .= ',';
			$sql .= " price={$_POST['price']} ";
			$need_comma = true;
		}
		if (!empty($_POST['action'])) {
			if ($need_comma)
				$sql .= ',';
			$sql .= " id_action='{$_POST['action']}' ";
			$need_comma = true;
		}
		$sql .= " WHERE id={$_POST['edit-id']} ";
		$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$db = $this->get_db();
		try {
			$prep = $db->query($sql);
			http_response_code(202);
			echo 'edit ok';

			header("Location: http://www.pv111.loc/shop?page={$current_page}" . (isset( $_GET['min-price'])? "&min-price={$_GET['min-price']}" : "") . (isset( $_GET['max-price'])? "&max-price={$_GET['max-price']}" : ""));
		} catch (PDOException $ex) {
			http_response_code(500);
			echo $ex->getMessage();
			$this->log_error(__METHOD__ . "#" . __LINE__ . $ex->getMessage() . "{$sql}");
			// $this->send_error(500);
		}
	}

	protected function do_delete()
	{
		$db = $this->get_db();
		if (empty($_GET['id'])) {
			$this->send_error(400, "Parameter 'id' required");
		}
		$sql = "UPDATE products SET delete_dt = CURRENT_TIMESTAMP WHERE id = ?";
		try {
			$prep = $db->prepare($sql);
			$prep->execute([$_GET['id']]);
			http_response_code(202); // Created
			echo 'DELETE OK';
		} catch (PDOException $ex) {
			$this->log_error(__METHOD__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
			$this->send_error(500);
		}
	}

	protected function do_purge()
	{
		$db = $this->get_db();
		if (empty($_GET['id'])) {
			$this->send_error(400, "Parameter 'id' required");
		}
		$sql = "UPDATE products SET delete_dt = NULL WHERE id = ?";
		try {
			$prep = $db->prepare($sql);
			$prep->execute([$_GET['id']]);
			http_response_code(202); // Restored
			// echo 'PURGE OK';
		} catch (PDOException $ex) {
			$this->log_error(__METHOD__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
			$this->send_error(500);
		}
	}
}