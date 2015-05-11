<?php
/**
 * Project: vortex.com
 * Author: superuser
 * Date: 07-May-15
 * Time: 19:31
 */

namespace vortex\auth;


use vortex\hashing\GenericHasher;
use vortex\hashing\HasherInterface;
use vortex\storage\StorageInterface;

class AuthManager {
    const USER_STORAGE_KEY = '_user';

    /**
     * @var \vortex\storage\StorageInterface
     */
    private $storage;
    private $provider;
    private $hasher;
    private $user;

    public function __construct(StorageInterface $storage, UserProviderInterface $provider, HasherInterface $hasher = null) {
        if (!$hasher)
            $hasher = new GenericHasher();

        $this->storage = $storage;
        $this->provider = $provider;
        $this->hasher = $hasher;

        $this->init();
    }

    private function init() {
        $this->user = $this->storage->load(self::USER_STORAGE_KEY);
    }

    public function check() {
        return !is_null($this->user);
    }

    public function guest() {
        return !$this->check();
    }

    public function user() {
        return $this->user;
    }

    public function id() {
        return $this->user->getAuthIdentifier();
    }

    public function login($identity, $password) {
        $identity = (string) $identity;
        $hash = $this->hasher->make($password);
        $result = $this->provider->retrieveByCredentials($identity, $hash);
        if (!$result)
            return false;
        $this->user = $result;
        $this->storage->save(self::USER_STORAGE_KEY, $result);
        return $result;
    }

    public function logout() {
        $result = $this->storage->delete(self::USER_STORAGE_KEY);
        if ($result)
            $this->user = null;
        return $result;
    }
} 