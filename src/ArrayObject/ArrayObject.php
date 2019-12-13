<?php
/**
 * A PHP class implementing ArrayAccess interface
 *
 * PHP VERSION >= 7
 * 
 * @category ArrayObject
 * @package  ArrayObject
 * @author   Masahiro IUCHI <masahiro.iuchi@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @version  GIT: <git_id>
 * @link     https://github.com/masiuchi/php-array-object
 */
namespace ArrayObject;

use ArrayAccess;
use Countable;

/**
 * A PHP class implementing ArrayAccess interface
 * 
 * @category ArrayObject
 * @package  ArrayObject
 * @author   Masahiro IUCHI <masahiro.iuchi@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/masiuchi/php-array-object
 */
class ArrayObject implements ArrayAccess, Countable
{
    const VERSION = '0.1.0';

    /**
     * Set value
     * 
     * @param mix $offset key
     * @param mix $value  value
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $numericalKeys = array_filter(
                array_keys(get_object_vars($this)),
                function ($key) {
                    return is_numeric($key);
                }             
            );
            if (count($numericalKeys) > 0) {
                $offset = max($numericalKeys) + 1;
            } else {
                $offset = 0;
            }
        }

        $this->{$offset} = $value;
    }

    /**
     * Check set value
     * 
     * @param mix $offset key
     * 
     * @return bool value is set or not
     */
    public function offsetExists($offset)
    {
        return isset($this->{$offset});
    }

    /**
     * Unset value
     * 
     * @param mix $offset key
     * 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->{$offset});
    }

    /**
     * Get value
     * 
     * @param mix $offset key
     * 
     * @return mix value
     */
    public function offsetGet($offset)
    {
        return isset($this->{$offset}) ? $this->{$offset} : null;
    }

    /**
     * Count values
     * 
     * @return int count of value
     */
    public function count()
    {
        return count(get_object_vars($this));
    }
}