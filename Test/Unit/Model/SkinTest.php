<?php
/**
 * Created by PhpStorm.
 * User: jbritts
 * Date: 2/12/18
 * Time: 2:25 PM
 */

namespace MagentoEse\ThemeCustomizer\Test\Unit\Model;


class SkinTest extends \PHPUnit\Framework\TestCase
{
    protected $skin;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->skin = $objectManager->getObject(\MagentoEse\ThemeCustomizer\Model\Skin::class);
    }

    public function testGetName()
    {
        $name = "test name";
        $this->skin->setName($name);
        $this->assertEquals($name,
            $this->skin->getName()
        );
    }

    public function testGetAppliedTo()
    {
        $id = 22;
        $this->skin->setAppliedTo($id);
        $this->assertEquals($id,
            $this->skin->getAppliedTo()
        );
    }

    public function testGetSkinId()
    {
        $id = 2;
        $this->skin->setSkinId($id);
        $this->assertEquals($id,
            $this->skin->getSkinId()
        );
    }

    public function testGetReadOnly()
    {
        $id = 1;
        $this->skin->setReadOnly($id);
        $this->assertEquals($id,
            $this->skin->getReadOnly()
        );
    }

    protected function tearDown()
    {
        $this->skin = null;
    }
}