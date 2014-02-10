<?php

class Album extends Base {

	public function getThumbnails($id) {

		$id = $this->db->qstr($id);
		$rs = $this->db->Execute("SELECT * FROM albums WHERE id=$id");

		while (!$rs->EOF) {

			$data = $rs->fields;
			$rs->MoveNext();

			$data = array();
			$data["id"] = $rs->get("id");
			$data["path"] = self::resolvePath($rs->get("path"));
			$returnValue[] = $data;

		}

		return $returnValue;

	}


	public static function resolvePath($album, $path) {

		

	}

}

?>
