<?php
namespace HtmlWebStorage;

/**
 * Implementing HTML5 Web Storage in PHP
 * Status : Experiment (Not being implemented anywhere in the source code)
 *
 * PROS :
 * - More secure than using cookies
 * - Large amount of data storage (at least 5MB)
 * - Supported by modern web browsers (Including IE 8+)
 *
 * CONS :
 * - Just like cookies, user can still disable web storage from the browser
 * - The passed data will still be visible as web storage is implemented on the client side through javascript.
 *   Encrypting/Decrypting data on the server side is necessary if we are dealing with a sensitive info.
 *   However, the operation will incur extra overhead in term of performance.
 *
 * Additional Info: Implementing extensibility (plug-ins) pattern.
 */
interface Cacheable {
    public function set($key, $data);
    public function get($key);
    public function delete($key);
    public function clear();
}

?>
