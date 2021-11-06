<?php
include "db_config.php";
class User
{
	protected $db;
	public function __construct()
	{
		$this->db = new DB_con();
		$this->db = $this->db->ret_obj();
	}


	
	/*** for registration process ***/

	public function reg_user($name, $username, $password, $email, $dep_id, $role_id)
	{
		//echo "k";

		$password = md5($password);

		//checking if the username or email is available in db
		$query = "SELECT * FROM users WHERE uname='$username' OR uemail='$email'";

		$result = $this->db->query($query) or die($this->db->error);

		$count_row = $result->num_rows;

		//if the username is not in db then insert to the table

		if ($count_row == 0) {
			$query = "INSERT INTO users SET uname='$username', upass='$password', fullname='$name',dep_id='$dep_id',role_id='$role_id', uemail='$email'";

			$result = $this->db->query($query) or die($this->db->error);

			return true;
		} else {
			return false;
		}
	}


	public function assignUpdate($updateid, $assignto, $dep_id, $role_id)
	{

		if ($assignto != NULL) {
			$query = "UPDATE users SET assignTo='$assignto', dep_id='$dep_id', role_id='$role_id' WHERE uid=$updateid";

			$result = $this->db->query($query) or die($this->db->error);

			return true;
		} else {
			return false;
		}
	}


	/*** for login process ***/
	public function check_login($emailusername, $password)
	{
		$password = md5($password);

		$query = "SELECT uid from users WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";

		$result = $this->db->query($query) or die($this->db->error);


		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		$count_row = $result->num_rows;

		if ($count_row == 1) {
			$_SESSION['login'] = true; // this login var will use for the session thing
			$_SESSION['uid'] = $user_data['uid'];
			return true;
		} else {
			return false;
		}
	}




	public function get_fullname($uid)
	{
		$query = "SELECT * FROM users WHERE uid = $uid";

		$result = $this->db->query($query) or die($this->db->error);

		$user_data = $result->fetch_array(MYSQLI_ASSOC);

		$depid = $user_data['dep_id'];
		$userquery = "SELECT * FROM users WHERE dep_id = $depid";
		$userresult = $this->db->query($userquery) or die($this->db->error);


		$assignquery = "SELECT * FROM users WHERE assignTo = $uid";
		$assignusers = $this->db->query($assignquery) or die($this->db->error);





		if ($user_data['role_id'] == 1) {
			$userrole = "CEO";
			$underrole = "
			COO<br>
			GENERAL MANAGER<br>
			MANAGER<br>
			SUPERVISOR<br>
			STAFFS<br>
			";
		} else if ($user_data['role_id'] == 2) {
			$userrole = "COO";
			$underrole = "
			GENERAL MANAGER<br>
			MANAGER<br>
			SUPERVISOR<br>
			STAFFS<br>
			";
		} else if ($user_data['role_id'] == 3) {
			$userrole = "GENERAL MANAGER";
			$underrole = "
			MANAGER<br>
			SUPERVISOR<br>
			STAFFS<br>
			";
		} else if ($user_data['role_id'] == 4) {
			$userrole = "MANAGER";
			$underrole = "
			SUPERVISOR<br>
			STAFFS<br>
			";
		} else if ($user_data['role_id'] == 5) {
			$userrole = "SUPERVISOR";
			$underrole = "
			STAFFS<br>
			";
		} else {
			$userrole = "STAFFS";
		}

		if ($user_data['dep_id'] == 1) {
			$department = "A";
		} else if ($user_data['dep_id'] == 2) {
			$department = "B";
		} else {
			$department = "C";
		}



		echo "
		
		<div style='text-align:center;'>
		<h2>Welcome to your Dashboard which role as a <span style='color:green'> {$userrole}</span></h2><br>
		<h3>Role: {$userrole}<br>
		<h3>Name: {$user_data['uname']}<br>
		Email: {$user_data['uemail']}<br>
		Department: {$department}</h3><br>

		<table class='table table-bordered'>
		<tr><th>OwnRole</th><th>UnderRole</th><th>STAFFS OF DEPARTMENT ({$department})</th></tr>
		<tr><td>{$userrole}</td><td>{$underrole}</td>
		
		<td>";
		if ($userresult->num_rows > 0) {
			while ($row = $userresult->fetch_assoc()) {
				echo $row['uname'];
				if ($row['role_id'] == 1) {
					echo "(CEO)<a href='assign.php?assuid={$row['uid']}'>AssignTo</a><br>";
				} else if ($row['role_id'] == 2) {
					echo "(COO) <a href='assign.php?assuid={$row['uid']}'>AssignTo</a><br>";
				} else if ($row['role_id'] == 3) {
					echo "(GENERAL MANAGER)<a href='assign.php?assuid={$row['uid']}'>AssignTo</a><br>";
				} else if ($row['role_id'] == 4) {
					echo "(MANAGER)<a href='assign.php?assuid={$row['uid']}'>AssignTo</a><br>";
				} else if ($row['role_id'] == 5) {
					echo "(SUPERVISOR)<a href='assign.php?assuid={$row['uid']}'>AssignTo</a><br>";
				} else {
					echo "(STAFFS)<br>";
				}
				"<br>";
			}
		} else {
			echo "0 results";
		}



		"</td>
		</tr>
		</table>
		</div><br>";

		echo "<table class='table table-bordered'>
		<tr><th>ASSIGNED STAFFS</th></tr>
		<tr><td>";

		if ($assignusers->num_rows > 0) {
			while ($row = $assignusers->fetch_assoc()) {
				echo $row['uname'];
				if ($row['role_id'] == 1) {
					echo "(CEO)<br>";
				} else if ($row['role_id'] == 2) {
					echo "(COO)<br>";
				} else if ($row['role_id'] == 3) {
					echo "(GENERAL MANAGER)<br>";
				} else if ($row['role_id'] == 4) {
					echo "(MANAGER)<br>";
				} else if ($row['role_id'] == 5) {
					echo "(SUPERVISOR)<br>";
				} else {
					echo "(STAFFS)<br>";
				}
				"<br>";
			}
		} else {
			echo "0 results";
		}


		"</td>
		</tr>
		</table>";
	}





	public function users()
	{
		$userquery = "SELECT * FROM users";
		$userresult = $this->db->query($userquery) or die($this->db->error);

		echo "<select name='assignto' required>";
		if ($userresult->num_rows > 0) {
			while ($row = $userresult->fetch_assoc()) {


				echo "<option value='{$row['uid']}'>
			 {$row['uname']} 
		 
			 </option>";
			}
		};
		echo "</select>";
	}

	/*** starting the session ***/
	public function get_session()
	{
		return $_SESSION['login'];
	}

	public function user_logout()
	{
		$_SESSION['login'] = FALSE;
		unset($_SESSION);
		session_destroy();
	}
}
