<?php

class User extends Base {

	var $id;
	var $data;

	public function __construct($uid) {
		$this->id = $id;
	}

	public function load() {

		if (is_null($this->data)) {

			$id = $this->DB->qstr($id);
			$rs = $this->DB->Execute("SELECT * FROM users WHERE id=$id");
			$this->data = $rs->fields;

		}
	}

	public function getAlbums() {

		$returnValue = array();
		$this->load();
		$rs = $this->DB->Execute("SELECT * FROM albums WHERE user_id=$id");

		while (!$rs->EOF) {

			$data = $rs->fields;
			$rs->MoveNext();

			$album = new Album($rs->get("id"));

			$data = array();
			$data["id"] = $rs->get("id");
			$data["name"] = $rs->get("name");
			$data["thumbnails"] = $album->getThumbnails($rs->get("id"));
			$returnValue[] = $data;

		}

		return $returnValue;

	}
}

?>
