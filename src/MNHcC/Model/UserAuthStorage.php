<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Model {

    use Zend\Authentication\Storage;

    /**
     * UserAuthStorage
     *
     * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @copyright 2015, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @license default
     */
    class UserAuthStorage extends Storage\Session {

	public function setRememberMe($rememberMe = 0, $time = 1209600) {
	    if ($rememberMe == 1) {
		$this->session->getManager()->rememberMe($time);
	    }
	}

	public function forgetMe() {
	    $this->session->getManager()->forgetMe();
	}

    }

}
