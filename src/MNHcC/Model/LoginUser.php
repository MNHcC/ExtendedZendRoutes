<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Model {

    use Zend\Form\Annotation;
    
    /**
     * LoginUser
     *
     * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @copyright 2015, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @license default
     * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
     * @Annotation\Name("LoginUser")
     */
    class LoginUser {

	/**
	 * @Annotation\Type("Zend\Form\Element\Text")
	 * @Annotation\Required({"required":"true" })
	 * @Annotation\Filter({"name":"StripTags"})
	 * @Annotation\Options({"label":"Username:"})
	 */
	public $username;

	/**
	 * @Annotation\Type("Zend\Form\Element\Password")
	 * @Annotation\Required({"required":"true" })
	 * @Annotation\Filter({"name":"StripTags"})
	 * @Annotation\Options({"label":"Password:"})
	 */
	public $password;

	/**
	 * @Annotation\Type("Zend\Form\Element\Checkbox")
	 * @Annotation\Options({"label":"Remember Me ?:"})
	 */
	public $rememberme;

	/**
	 * @Annotation\Type("Zend\Form\Element\Submit")
	 * @Annotation\Attributes({"value":"Submit"})
	 */
	public $submit;

    }

}
