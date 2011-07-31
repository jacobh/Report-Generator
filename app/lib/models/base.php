<?php

class ModelBase {
	
	private static $pdo;
	
	private function __construct($obj = array(), $marshal = true) {
		$this->columns = array();
		foreach($obj as $k=>$v) {
			$this->$k = $v;
			$this->columns[] = $k;
		}
		if($marshal) {
			$this->marshal_from_db();
		}
	}
	
	public static function create($data = array()) {
		$table_name = self::table_name();
		$class_name = get_called_class();
		self::$pdo->query("INSERT INTO $table_name () VALUES ()");
		$stmt = self::$pdo->query("SELECT * FROM $table_name WHERE id = LAST_INSERT_ID()");
		$obj = new $class_name($stmt->fetch(PDO::FETCH_ASSOC), false);
		$obj->created_at = time();
		foreach($data as $k => $v) {
			$obj->$k = $v;
		}
		$obj->save();
		return $obj;
	}
	
	public function save() {
		if(in_array("updated_at", $this->columns)) {
			$this->updated_at = time();
		}
		$table_name = self::table_name();
		$sets = "";
		$params = array();
		foreach($this->marshal_to_db() as $k=>$v) {
			if($k == "id") continue;
			$params[] = $v;
			if($sets != "") {
				$sets .= ", ";
			}
			$sets .= "$k = ? ";
		}
		$stmt = self::$pdo->prepare("UPDATE $table_name SET $sets WHERE id = ?");
		$params[] = $this->id;
		$stmt->execute($params);
	}
	
	private function marshal_to_db() {
		$data = array();
		foreach($this->columns as $col) {
			if(isset($this->on_save[$col])) {
				$fn = $this->on_save[$col];
				$data[$col] = $fn($this->$col);
			} else {	
				$data[$col] = $this->$col;
			}
		}
		return $data;
	}
	
	
	private function marshal_from_db() {
		foreach($this->columns as $col) {
			if(isset($this->on_restore[$col])) {
				$fn = $this->on_restore[$col];
				$this->$col = $fn($this->$col);
			}
		}
	}
	
	public function __get($name) {
		$model_class = ucfirst(preg_replace_callback("/_(?<letter>[a-z])/", function($m) {
			return strtoupper($m['letter']);
		}, $name));
		if(isset($this->belongs_to) && in_array($name, $this->belongs_to)) {
			$name_id = "${name}_id";
			return $model_class::find($this->$name_id);
		}
		if(isset($this->has_many) && in_array($name, $this->has_many)) {
			$by_name_id = "by_" . self::table_name() . "_id";
			$a = $model_class::$by_name_id($this->id);
			return $a;
		}
		return NULL;
	}
	
	public static function get($param = NULL) {
		global $params;
		if($param == NULL) {
			$param = self::table_name() . "_id";
		}	
		expects(array($param => "int"));
		return self::find($params[$param]);
	}
	
	public static function find($id) {
		return self::find_by_id($id);
	}
	
	public static function delete($id) {
		$table = self::table_name();
		$stmt = self::$pdo->prepare("DELETE FROM $table WHERE id = ?");
		$stmt->execute(array($id));
	}
	
	public function destroy() {
		$table = self::table_name();
		$stmt = self::$pdo->prepare("DELETE FROM $table WHERE id = ?");
		$stmt->execute(array($this->id));
	}
	
	public static function all($order = NULL) {
		$model_class = get_called_class();
		$objects = array();
		$table = self::table_name();
		$stmt = self::$pdo->prepare("SELECT * FROM $table " . ($order ? "ORDER BY $order" : ""));
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$objects[] = new $model_class($row);
		}
		return $objects;
	}
	
	private static function table_name() {
		return strtolower(preg_replace("/([a-z])([A-Z])/", '${1}_${2}', get_called_class()));
	}
	
	public static function __callStatic($name, $arguments) {
		if(preg_match('/^find_by_(?<column>[a-z_]+)$/', $name, $matches)) {
			$model_class = get_called_class();
			$table = self::table_name();
			$stmt = self::$pdo->prepare("SELECT * FROM $table WHERE $matches[column] = ?");
			$stmt->execute(array($arguments[0]));
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return new $model_class($row);
			}
			return NULL;
		}
		if(preg_match('/^by_(?<column>[a-z_]+)$/', $name, $matches)) {
			$model_class = get_called_class();
			$table = self::table_name();
			$stmt = self::$pdo->prepare("SELECT * FROM $table WHERE $matches[column] = ?");
			$stmt->execute(array($arguments[0]));
			$objects = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$objects[] = new $model_class($row);
			}
			return $objects;
		}
	}
	
	public static function connect() {
		global $config;
		try {
			self::$pdo = new PDO($config["db"]["dsn"], $config["db"]["user"], $config["db"]["pass"]);
		} catch(PDOException $e) {
			?>
			<h1>Database connection failure</h1>
			<p>
				Please ensure the database settings in config.php are correct.
			</p>
			<table border="1" cellpadding="4">
				<tr>
					<th>DSN</th>
					<td><?php h($config['db']['dsn']) ?></td>
				</tr>
				<tr>
					<th>Username</th>
					<td><?php h($config['db']['user']) ?></td>
				</tr>
				<tr>
					<th>Password</th>
					<td><?php echo $config['db']['pass'] ? preg_replace(".", "*", $config['db']['pass']) : "<i>None</i>" ?></td>
				</tr>
			</table>
			<?php
			exit;
		}
	}
}
ModelBase::connect();