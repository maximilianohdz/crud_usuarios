<?php
class Administrator extends db{
	
	private function view_users(){
		try {
			$SQL = "SELECT r.rol_nombre as nombre_rol, u.user_ID, u.user_username, u.user_password, u.user_rol
				FROM user u
				LEFT JOIN rol r
				ON u.user_rol = r.rol_ID";
			$result = $this->connect()->prepare($SQL);
			$result->execute();
			return $result->fetchAll(PDO::FETCH_OBJ);	
		} catch (Exception $e) {
			die('Error Administrator(view_users) '.$e->getMessage());
		} finally{
			$result = null;
		}
	}

	function get_view_users(){
		return $this->view_users();
	}

	private function register_users($data){
		try {
			$SQL = 'INSERT INTO user (user_username, user_password, user_rol) VALUES (?,?,?)';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array(
									$data['name'],
									$data['last_name'],
									$data['email']
									)
							);			
		} catch (Exception $e) {
			die('Error Administrator(register_users) '.$e->getMessage());
		} finally{
			$result = null;
		}
	}

	function set_register_user($data){
		$this->register_users($data);
	}

	private function update_user($data){
		try {
			$SQL = 'UPDATE user SET user_username = ?, user_password= ?, user_rol = ? WHERE user_ID = ?';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array(
									$data['name'],
									$data['last_name'],
									$data['email'],
									$data['id']
									)
							);			
		} catch (Exception $e) {
			die('Error Administrator(update_user) '.$e->getMessage());
		} finally{
			$result = null;
		}
	}

	function set_update_user($data){
		$this->update_user($data);
	}

	private function delete_user($id){
		try {
			$SQL = 'DELETE FROM user WHERE user_ID = ?';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array($id));			
		} catch (Exception $e) {
			die('Error Administrator(delete_user) '.$e->getMessage());
		} finally{
			$result = null;
		}
	}

	function set_delete_user($id){
		$this->delete_user($id);
	}	
}
?>