<?php
/**
 * Test file for ArrayableObject
 *
 * PHP VERSION >= 7
 * 
 * @category ArrayableObject
 * @package  ArrayableObject
 * @author   Masahiro IUCHI <masahiro.iuchi@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @version  GIT: <git_id>
 * @link     https://github.com/masiuchi/php-arrayable-object
 */
namespace ArrayableObject\Test;

use PHPUnit\Framework\TestCase;

use ArrayableObject\ArrayableObject;
use stdClass;

/**
 * Test class for ArrayableObject
 * 
 * @category Test
 * @package  ArrayObject\Test
 * @author   Masahiro IUCHI <masahiro.iuchi@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/masiuchi/php-arrayable-object
 */

class ArrayableObjectTest extends TestCase
{
    /**
     * Test constructor
     * 
     * @test
     * @return void
     */
    public function testConstructor()
    {
        $obj = new ArrayableObject;
        $this->assertInstanceOf('ArrayableObject\ArrayableObject', $obj);
    }

    /**
     * Test object behavior
     * 
     * @test
     * @return void
     */
    public function testObjectBehavior()
    {
        $obj = new ArrayableObject;
        $obj->a = 1;
        $obj->{'b'} = 2;
        
        $this->assertEquals(1, $obj->{'a'});
        $this->assertEquals(2, $obj->b);
        $this->assertNotTrue(isset($obj->c));

        unset($obj->a);
        $this->assertNotTrue(isset($obj->a));

        $expected = [ 'b' => 2 ];
        $this->assertEquals($expected, get_object_vars($obj));
    }

    /**
     * Test array behavior
     * 
     * @test
     * @return void
     */
    public function testArrayBehavior()
    {
        $obj = new ArrayableObject;
        $obj[] = 1;
        $obj[] = 2;

        $this->assertEquals(1, $obj[0]);
        $this->assertEquals(2, $obj[1]);
        $this->assertEquals(2, count($obj));
    }

    /**
     * Test associative array behavior
     * 
     * @test
     * @return void
     */
    public function testAssociativeArrayBehavior()
    {
        $obj = new ArrayableObject;
        $obj['a'] = 1;
        $obj['b'] = 2;

        $this->assertEquals(1, $obj['a']);
        $this->assertEquals(2, $obj['b']);
        $this->assertNotTrue(isset($obj['c']));

        unset($obj['a']);
        $this->assertNotTrue(isset($obj['a']));

        $expected = [ 'b' => 2 ];
        $this->assertEquals($expected, (array) $obj);
    }

    /**
     * Test foreach function
     * 
     * @test
     * @return void
     */
    public function testForeachFunction()
    {
        $obj = new ArrayableObject;
        $obj->{'a'} = 1;
        $obj->{'b'} = 2;

        foreach ($obj as $key => $value) {
            if (in_array($key, ['a', 'b'])) {
                $this->assertEquals($value, $obj->{$key});
            } else {
                $this->assertTrue(false);
            }
        }
    }

    /**
     * Test to use different interface
     * 
     * @test
     * @return void
     */
    public function testDifferentInterface()
    {
        $obj = new ArrayableObject;

        $obj['a'] = 1;
        $this->assertEquals(1, $obj->{'a'});

        $obj->{'b'} = 2;
        $this->assertEquals(2, $obj['b']);

        $obj[] = 3;
        $this->assertEquals(3, $obj->{'0'});
    }
}
