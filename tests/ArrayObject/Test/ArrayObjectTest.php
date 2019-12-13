<?php
/**
 * Test file for ArrayObject
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
namespace ArrayObject\Test;

use PHPUnit\Framework\TestCase;

use ArrayObject\ArrayObject;
use stdClass;

/**
 * Test class for ArrayObject
 * 
 * @category Test
 * @package  ArrayObject\Test
 * @author   Masahiro IUCHI <masahiro.iuchi@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/masiuchi/php-array-object
 */

class ArrayObjectTest extends TestCase
{
    /**
     * Test constructor
     * 
     * @test
     * @return void
     */
    public function testConstructor()
    {
        $obj = new ArrayObject;
        $this->assertInstanceOf('ArrayObject\ArrayObject', $obj);
    }

    /**
     * Test object behavior
     * 
     * @test
     * @return void
     */
    public function testObjectBehavior()
    {
        $obj = new ArrayObject;
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
        $obj = new ArrayObject;
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
        $obj = new ArrayObject;
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
        $obj = new ArrayObject;
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
     * Test to use difference interface
     * 
     * @test
     * @return void
     */
    public function testDiffernceInterface()
    {
        $obj = new ArrayObject;

        $obj['a'] = 1;
        $this->assertEquals(1, $obj->{'a'});

        $obj->{'b'} = 2;
        $this->assertEquals(2, $obj['b']);

        $obj[] = 3;
        $this->assertEquals(3, $obj->{'0'});
    }
}
