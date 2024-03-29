<?php

declare(strict_types=1);

namespace Presentation\Web\Middleware\Session;

interface SessionInterface
{
    /**
     * Serialize the session data to an array for storage purposes.
     */
    public function toArray(): array;

    /**
     * Retrieve a value from the session.
     *
     * @param int|bool|string|float|mixed[]|object|JsonSerializable|null $default     
     * @return mixed
     */
    public function get(string $name, $default = null);

    /**
     * Whether or not the container has the given key.
     */
    public function has(string $name): bool;

    /**
     * Set a value within the session.
     *
     * Values MUST be serializable in any format; we recommend ensuring the
     * values are JSON serializable for greatest portability.
     *
     * @param int|bool|string|float|mixed[]|object|JsonSerializable|null $value
     */
    public function set(string $name, $value): void;

    /**
     * Remove a value from the session.
     */
    public function unset(string $name): void;

    /**
     * Clear all values.
     */
    public function clear(): void;

    /**
     * Does the session contain changes? If not, the middleware handling
     * session persistence may not need to do more work.
     */
    public function hasChanged(): bool;

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
    public function regenerate(): self;

    /**
     * Method to determine if the session was regenerated; should return
     * true if the instance was produced via regenerate().
     */
    public function isRegenerated(): bool;
}
