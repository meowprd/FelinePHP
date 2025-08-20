<?php

namespace meowprd\FelinePHP\Http;

/**
 * Session management class for handling PHP session data.
 *
 * Provides a simple, object-oriented interface for working with session storage.
 * Automatically starts session upon instantiation.
 */
class Session
{

    /**
     * Start a new session
     * @return self
     */
    public function start(): self {
        session_start();
        return $this;
    }

    /**
     * Set a session value.
     *
     * @param string $key Session key
     * @param mixed $value Value to store
     * @return self Returns instance for method chaining
     */
    public function set(string $key, mixed $value): self
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    /**
     * Get a session value.
     *
     * @param string $key Session key to retrieve
     * @param mixed $default Default value if key doesn't exist
     * @return mixed Stored value or default
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Remove a session value.
     *
     * @param string $key Session key to remove
     * @return self Returns instance for method chaining
     */
    public function remove(string $key): self
    {
        unset($_SESSION[$key]);
        return $this;
    }

    /**
     * Destroy the entire session.
     *
     * @return self Returns instance for method chaining
     */
    public function destroy(): self
    {
        session_destroy();
        return $this;
    }

    /**
     * Check if a session key exists.
     *
     * @param string $key Session key to check
     * @return bool True if key exists, false otherwise
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Get session ID.
     *
     * @return string Current session ID
     */
    public function getId(): string
    {
        return session_id();
    }

    /**
     * Regenerate session ID.
     *
     * Useful for security purposes to prevent session fixation attacks.
     *
     * @param bool $deleteOldSession Whether to delete the old session
     * @return self Returns instance for method chaining
     */
    public function regenerate(bool $deleteOldSession = true): self
    {
        session_regenerate_id($deleteOldSession);
        return $this;
    }

    /**
     * Get all session data.
     *
     * @return array Complete session data
     */
    public function all(): array
    {
        return $_SESSION;
    }

    /**
     * Clear all session data without destroying the session.
     *
     * @return self Returns instance for method chaining
     */
    public function clear(): self
    {
        $_SESSION = [];
        return $this;
    }

    /**
     * Set flash message for next request.
     *
     * @param string $key Flash message key
     * @param mixed $value Flash message value
     * @return self Returns instance for method chaining
     */
    public function flash(string $key, mixed $value): self
    {
        $_SESSION['_flash'][$key] = $value;
        return $this;
    }

    /**
     * Get flash message and remove it.
     *
     * @param string $key Flash message key
     * @param mixed $default Default value if key doesn't exist
     * @return mixed Flash message value or default
     */
    public function getFlash(string $key, mixed $default = null): mixed
    {
        $value = $_SESSION['_flash'][$key] ?? $default;
        unset($_SESSION['_flash'][$key]);
        return $value;
    }

    /**
     * Check if flash message exists.
     *
     * @param string $key Flash message key
     * @return bool True if flash message exists
     */
    public function hasFlash(string $key): bool
    {
        return isset($_SESSION['_flash'][$key]);
    }
}