<?php
namespace HtmlWebStorage;

class HtmlLocalStorage implements Cacheable {
    public function __construct() {
        echo "<script type='text/javascript'>" .
                  "if ('localStorage' in window && window['localStorage'] !== null) {" .
                      "function set(key, data) {" .
                          "localStorage.setItem(key, data);" .
                      "}" .
                      "function get(key) {" .
                          "return localStorage.getItem(key);" .
                      "}" .
                      "function remove(key) {" .
                          "localStorage.removeItem(key);" .
                      "}" .
                      "function clear() {" .
                          "localStorage.clear();" .
                      "}" .
                  "}" .
             "</script>";
    }

    /* Save an item to the local storage */
    public function set($key, $data) {
        if (!is_string($key) || !is_string($data)) {
            throw new HtmlStorageException('The supplied key and data for the set() method must be strings.');
        }

        echo "<script type='text/javascript'>set('" . $key . "','" . $data . "')</script>";
    }

    /* Get an item from the local storage (basic implementation) */
    public function get($key) {
        if (!is_string($key)) {
            throw new HtmlStorageException('The supplied key for the get() method must be string.');
        }

        echo "<script type='text/javascript'>get('" . $key . "')</script>";
    }

    /* Remove an item from the local storage */
    public function delete($key) {
        if (!is_string($key)) {
            throw new HtmlStorageException('The supplied key for the delete() method must be string.');
        }

        echo "<script type='text/javascript'>remove('" . $key . "')</script>";
    }

    /* Clear the local storage */
    public function clear() {
        echo "<script type='text/javascript'>clear();</script>";
    }
}
?>
