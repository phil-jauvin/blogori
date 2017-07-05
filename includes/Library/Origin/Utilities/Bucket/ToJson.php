<?php
namespace Origin\Utilities\Bucket;

trait ToJson {
	public function ToJson(){
		return json_encode($this->things);
	}
}
