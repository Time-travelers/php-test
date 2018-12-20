<?php
class APIXXWSH {
	public function apixwsh($parameter, $option = "foo") {
	   return $parameter;
	}
	protected function client_can_not_see() {
	
	}
}
$service = new Yar_Server(new APIXXWSH());
$service->handle();