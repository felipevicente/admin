<?php

class Msg {
	
	public function MsgErro($msg){
		echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                '.$msg.'
              </div>';
	}
}

?>