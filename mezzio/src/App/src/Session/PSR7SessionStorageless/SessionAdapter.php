<?php

declare(strict_types=1);

namespace App\Session\PSR7SessionStorageless;

use App\Session\SessionInterface as SessionInterface;
use PSR7Sessions\Storageless\Session\SessionInterface as PSR7SessionsStoragelessSessionInterface;

class SessionAdapter implements SessionInterface
{
    public function __construct(
        private PSR7SessionsStoragelessSessionInterface $session
    ) {
    }

    /**
     * Serialize the session data to an array for storage purposes.
     */
    public function toArray(): array
    {
        throw new \LogicException('Method "toArray" is not implemeted yet...');
        return array(); // $this->session->jsonSerialize();
    }

    /**
     * Retrieve a value from the session.
     *
     * @param null|mixed $default Default value to return if $name does not exist.
     * @return mixed
     */
    public function get(string $name, $default = null): mixed
    {
        return $this->session->get($name, $default);
    }

    /**
     * Whether or not the container has the given key.
     */
    public function has(string $name): bool
    {
        return $this->session->has($name);
    }

    /**
     * Set a value within the session.
     *
     * Values MUST be serializable in any format; we recommend ensuring the
     * values are JSON serializable for greatest portability.
     *
     * @param mixed $value
     */
    public function set(string $name, $value): void
    {
        $this->session->set($name, $value);
    }

    /**
     * Remove a value from the session.
     */
    public function unset(string $name): void
    {
        $this->session->remove($name);
    }

    /**
     * Clear all values.
     */
    public function clear(): void
    {
        $this->session->clear();
    }

    /**
     * Does the session contain changes? If not, the middleware handling
     * session persistence may not need to do more work.
     */
    public function hasChanged(): bool
    {
        return $this->session->hasChanged();
    }

    /**
     * Regenerate the session.
     *
     * This can be done to prevent session fixation. When executed, it SHOULD
     * return a new instance; that instance should always return true for
     * isRegenerated().
     *
     * An example of where this WOULD NOT return a new instance is within the
     * shipped LazySession, where instead it would return itself, after
     * internally re-setting the proxied session.
     */
    public function regenerate(): self
    {
        return new self($this->session);
    }

    /**
     * Method to determine if the session was regenerated; should return
     * true if the instance was produced via regenerate().
     */
    public function isRegenerated(): bool
    {
        return true;
    }
}
