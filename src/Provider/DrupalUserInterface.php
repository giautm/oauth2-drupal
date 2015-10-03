<?php
/**
 * Created by PhpStorm.
 * User: giau.tran
 * Date: 10/3/2015
 * Time: 7:09 PM
 */

namespace GiauTM\OAuth2\Client\Provider;


interface DrupalUserInterface
{
    public function getId();

    public function getName();

    public function getEmail();

    public function getRoles();
}