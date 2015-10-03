<?php
/**
 * Created by PhpStorm.
 * User: giau.tran
 * Date: 9/27/2015
 * Time: 6:05 AM
 */

namespace GiauTM\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;


class DrupalUser implements ResourceOwnerInterface, DrupalUserInterface
{
    /**
     * @var array
     */
    protected $response;

    /**
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getId()
    {
        return $this->response['uid'];
    }

    /**
     * Get perferred user name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->response['name'];
    }

    /**
     * Returns the first name for the user as a string if present.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return null;
    }

    /**
     * Returns the last name for the user as a string if present.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return null;
    }

    /**
     * Get email address.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->response['mail'];
    }

    /**
     * Get user data as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }

    public function getRoles()
    {
        return $this->response['roles'];
    }
}