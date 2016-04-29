<?php

/**
 * This file contains a simple implementation of a registry.
 */

namespace dbeurive\Registry;

/**
 * Class Registry
 * This class contains a simple implementation of a registry.
 * @package dbeurive\Registry
 */

class Registry {

    /** @var array This property contains the registry's entries. */
    private static $__entries = array();
    /** @var array For each registry's entry, this property indicates whether the entry's value is constant or not. */
    private static $__constants = array();


    /**
     * Empty the registry.
     */
    public static function reset() {
        self::$__entries = [];
        self::$__constants = [];
    }

    /**
     * Register a new entry.
     * @param string $inEntryName Name of the entry to register.
     * @param mixed $inValue Value of the entry.
     * @param bool $inOptConstant This flag indicates whether the value should be considered to be a constant or not.
     *        If the flag's value is true, then the value is considered to be a constant.
     *        Otherwise, the value is not considered to be a constant.
     * @throws \Exception
     */
    public static function register($inEntryName, $inValue, $inOptConstant=false) {

        if (array_key_exists($inEntryName, self::$__entries)) {
            throw new \Exception(sprintf("The entry \"%s\" is already registered.", $inEntryName));
        }

        self::$__entries[$inEntryName]   = $inValue;
        self::$__constants[$inEntryName] = $inOptConstant;
    }

    /**
     * Set the value of a previously registered entry.
     * @param string $inEntryName Name of the entry.
     * @param mixed $inValue New value for the entry.
     * @throws \Exception
     */
    public static function set($inEntryName, $inValue) {
        if (! array_key_exists($inEntryName, self::$__entries)) {
            throw new \Exception(sprintf("The entry \"%s\" is not registered.", $inEntryName));
        }

        if (self::$__constants[$inEntryName]) {
            throw new \Exception(sprintf("The value of the entry \"%s\" can not be changed.", $inEntryName));
        }

        self::$__entries[$inEntryName] = $inValue;
    }

    /**
     * Return the value of a previously registered entry.
     * @param string $inEntryName Name of the entry.
     * @param bool $inOptThrowsExceptionIfNotExists This flag specifies whether an exception must be thrown if the requested entry is not registered.
     *        If the flag's value is true, then an exception is thrown if the requested entry is not registered.
     *        Otherwise, no exception is thrown if the requested entry is not registered.
     * @return mixed|null The method returns the value of the requested entry.
     *         If the value of `$inOptThrowsExcepetionIfNotExists` is `false`, and if the entry is not registered, then the method returns the value null.
     * @throws \Exception
     */
    public static function get($inEntryName, $inOptThrowsExceptionIfNotExists=true) {

        if (! array_key_exists($inEntryName, self::$__entries)) {
            if ($inOptThrowsExceptionIfNotExists) {
                throw new \Exception(sprintf("Attempt to get the value of a non-existent entry (%s)", $inEntryName));
            }
            return null;
        }

        return self::$__entries[$inEntryName];
    }

    /**
     * Test if an entry is registered.
     * @param string $inEntryName Name of the entry.
     * @return bool If the entry is registered, then the method returns true.
     *         Otherwise, it returns false.
     */
    public static function isRegistered($inEntryName) {
        return array_key_exists($inEntryName, self::$__entries);
    }

    /**
     * Test if a registered entry's value is considered to be a constant.
     * @param string $inEntryName Name of the entry.
     * @return bool If the entry's value is considered to be a constant, then the method returns true.
     *         Otherwise, it returns false.
     * @throws \Exception
     */
    public static function isConstant($inEntryName) {
        if (! array_key_exists($inEntryName, self::$__constants)) {
            throw new \Exception(sprintf("The requested value (%s) is not registered.", $inEntryName));
        }
        return self::$__constants[$inEntryName];
    }
}