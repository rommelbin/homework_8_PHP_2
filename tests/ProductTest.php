<?php


use app\models\entities\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductVariables_1()
    {
        $name = "Чай";
        $description = 'dasda';
        $price = 123;
        $consistOf = '123';
        $manufacturer = 'this';
        $product = new Product($name, $description, $price, $consistOf, $manufacturer);
        $this->assertEquals([$name, $description, $price, $consistOf, $manufacturer], [$product->name, $product->description, $product->price, $product->consistOf, $product->manufacturer]);
    }

    public function testProductProps_2()
    {
        $product = new Product('thisName');
        $product->name = 'NotThisName';
        $this->assertEquals(true, $product->props['name']);
        $this->assertEquals(false, $product->props['description']);
        $this->assertEquals(false, $product->props['manufacturer']);
        $this->assertEquals(false, $product->props['consistOf']);
        $this->assertEquals(false, $product->props['price']);
    }

    public function testProductConstructor_3() {
        $product_1 = new Product('eman', 'opt', 123);
        $this->assertNull($product_1->consistOf);
        $this->assertNull($product_1->manufacturer);
        $this->assertNotNull($product_1->name);
    }

    public function testProductClassName_4() {
        $className = explode('\\', Product::class);
        $this->assertEquals('Product', $className[count($className) - 1]);
    }
}