<?php
    // declare(strict_types=1);

  /**
   * Please make below code executable
   */

    class EcommerceCatalog {
        public function addRootCategory($var) {
            return $var;
        }
    }

    class Product extends Category {
        public string $name = 'noname';
        public int $quantity = 0;

        public function __construct(string $name) {
            $this->name = $name;

        }
        public function addQuantity(int $var) {
            $this->quantity = $var;
        }

        public function addProduct(string $var) {
            $this->name = $name;
        } 
    }

    
    class Category {
        public string $name;
        
        public function __construct(string $name) {
            $this->name = $name;

        }

        public function addChildCategory($var) {
            $add = new Category($var) ;

            return $var;

        }

        public function getCategory(): string {
            return $this->name;
        }
        
    }
    
    $rootCategory = new Category("root");

    $ecommerceCatalog = new EcommerceCatalog();   
    $ecommerceCatalog->addRootCategory($rootCategory);

    $womenCategory = new Category("Women products");
    $menCategory = new Category("Men products");

    $womenCategory->addChildCategory(new Category("Shoes"));
    $womenCategory->addChildCategory(new Category("Handbags"));

    $rootCategory->addChildCategory($womenCategory);
    $rootCategory->addChildCategory($menCategory);

    $product1 = new Product("product1");
    $product2 = new Product("product2");
    $product3 = new Product("product3");
    $product3->addQuantity(3);

    $womenCategory->addProduct($product3);
?>