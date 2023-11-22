<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

/**
 * Class KeycloakAuth
 * @author Douglas Gomes de Souza <douglas.souza@docplanner.com>
 * @package App\Http\Middleware
 * @see https://www.keycloak.org/docs/latest/securing_apps
 */
class KeycloakAuth
{
    public $attributes;

    // resources allowed by this server
    protected $allowedResources = ['feegow-rest-api'];
    //protected $allowedResources = ['feegow-pdf-generator'];


    /**
     * @throws AuthorizationException
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, $roles = null)
    {
        if(env('APP_ENV', 'production') == 'local') {
            return $next($request);
        }

        // authenticate request
        $decodedToken = $this->authenticate($request);

        // authorize token
        $this->validateResource($decodedToken);
        if(!empty($roles)) {
            $this->validateRoles($decodedToken, 'feegow-rest-api', explode('|', $roles));
        }

        return $next($request);
    }

    /**
     * Decode token, validate and authenticate user
     * @return object
     * @throws AuthenticationException
     */
    protected function authenticate(Request $request)
    {
        try {
            $decodedToken = $this->decodeToken($this->getTokenForRequest($request), $this->getPublickey());
        } catch(\Exception $e) {
            throw new AuthenticationException('Invalid token: ' . $e->getMessage());
        }

        if(!$decodedToken) {
            throw new AuthenticationException();
        }

        $request->attributes->add(['licenseId' => $decodedToken->licenseId ?? null]);
        $request->attributes->add(['userId' => $decodedToken->userId ?? null]);
        $request->attributes->add(['clientId' => $decodedToken->clientId ?? null]);
        $request->attributes->add(['scope' => $decodedToken->scope ?? null]);

        return $decodedToken;
    }

    /**
     * Get the token for the current request.
     * @return string
     */
    protected function getTokenForRequest(Request $request)
    {
        return $request->bearerToken();
    }


    /**
     * Get the public key from keycloak
     * @return string
     */
    protected function getPublickey()
    {
        // @TODO: retrieve remote key from keycloak and cache it
        $publicKey = env('KEYCLOAK_REALM_PUBLIC_KEY');

        // generate public key from string
        $publicKey = "-----BEGIN PUBLIC KEY-----\n" . wordwrap($publicKey, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
        return $publicKey;
    }

    /**
     * Decode a JWT token
     * @param string|null $token JWT token
     * @param string $publicKey Public key
     * @return object|null
     */
    protected function decodeToken(string $token = null, string $publicKey)
    {
        JWT::$leeway = 500; //clock difference between servers when validating token
        return $token ? JWT::decode($token, $publicKey, ['RS256']) : null;
    }

    /**
     * Validate if authenticated user has a valid resource for this server
     * @param object $decodedToken
     * @return void
     * @throws AuthorizationException
     */
    protected function validateResource(object $decodedToken)
    {
        $tokenResourceAccess = array_keys((array)($decodedToken->resource_access ?? []));

        if(count(array_intersect($tokenResourceAccess, $this->allowedResources)) == 0) {
            throw new AuthorizationException("The token is not allowed by this server.");
        }
    }

    /**
     * Check if authenticated user has a any role into resource
     * @param object $decodedToken
     * @param string $resource
     * @param array $roles
     * @return bool
     * @throws AuthorizationException
     */
    protected function validateRoles(object $decodedToken, string $resource, array $roles)
    {
        $tokenResourceAccess = (array)$decodedToken->resource_access ?? [];

        if(array_key_exists($resource, $tokenResourceAccess)) {
            $tokenResource = (array)$tokenResourceAccess[$resource];
            if(array_key_exists('roles', $tokenResource)) {
                foreach($roles as $role) {
                    if(in_array($role, $tokenResource['roles'])) {
                        return true;
                    }
                }
            }
        }
        throw new AuthorizationException("The token does not have permission to access this resource.");
    }

}
