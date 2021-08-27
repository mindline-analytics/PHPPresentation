<?php
/**
 * This file is part of PHPPresentation - A pure PHP library for reading and writing
 * presentations documents.
 *
 * PHPPresentation is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPPresentation/contributors.
 *
 * @see        https://github.com/PHPOffice/PHPPresentation
 *
 * @copyright   2009-2015 PHPPresentation contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Tests\Shape;

use PhpOffice\PhpPresentation\Shape\Table;
use PHPUnit\Framework\TestCase;

/**
 * Test class for Table element.
 *
 * @coversDefaultClass \PhpOffice\PhpPresentation\Shape\Table
 */
class TableTest extends TestCase
{
    public function testConstruct(): void
    {
        $object = new Table();
        $this->assertEmpty($object->getRows());
        $this->assertFalse($object->isResizeProportional());
    }

    public function testNumColums(): void
    {
        $value = mt_rand(1, 100);
        $object = new Table();

        $this->assertEquals(1, $object->getNumColumns());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Table', $object->setNumColumns($value));
        $this->assertEquals($value, $object->getNumColumns());
    }

    public function testRows(): void
    {
        $object = new Table();

        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Table\\Row', $object->createRow());
        $this->assertCount(1, $object->getRows());

        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Table\\Row', $object->getRow(0));
        $this->assertNull($object->getRow(1, true));
    }

    public function testGetRowException(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Row number out of bounds.');

        $object = new Table();
        $object->getRow();
    }

    public function testHashCode(): void
    {
        $object = new Table();
        $this->assertEquals(md5(get_class($object)), $object->getHashCode());

        $row = $object->createRow();
        $this->assertEquals(md5($row->getHashCode() . get_class($object)), $object->getHashCode());
    }
}
