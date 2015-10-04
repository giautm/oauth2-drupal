<?php
/**
 * Created by PhpStorm.
 * User: giau.tran
 * Date: 10/2/2015
 * Time: 9:51 AM
 */

namespace GiauTM\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use League\OAuth2\Client\Provider\AbstractProvider;

use Psr\Http\Message\ResponseInterface;


class Drupal extends AbstractProvider
{
    use BearerAuthorizationTrait;
    const ACCESS_TOKEN_RESOURCE_OWNER_ID = 'uid';
    protected $baseUrl;

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function getBaseAuthorizationUrl()
    {
        return $this->getBaseUrl() . '/oauth2/authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return $this->getBaseUrl() . '/oauth2/token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return $this->getBaseUrl() . '/oauth2/user/profile';
    }

    /**
     * @Override
     * Requests resource owner details.
     *
     * @param  AccessToken $token
     * @return mixed
     */
    protected function fetchResourceOwnerDetails(AccessToken $token)
    {
        $url = $this->getResourceOwnerDetailsUrl($token);

        // TODO: S?a bên drupal ?? có th? dùng ph??ng th?c GET.
        $request = $this->getAuthenticatedRequest(self::METHOD_POST, $url, $token);

        return $this->getResponse($request);
    }

    protected function getDefaultScopes()
    {
        return ['user_profile'];
    }

    protected function getScopeSeparator()
    {
        return ' ';
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['error'])) {
            throw new IdentityProviderException(
                $data['error_description'] ?: $response->getReasonPhrase(),
                $response->getStatusCode(),
                $response
            );
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new DrupalUser($response);
    }
}