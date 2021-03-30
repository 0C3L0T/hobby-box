<?php

namespace App\Factory;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Product|Proxy createOne(array $attributes = [])
 * @method static Product[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Product|Proxy find($criteria)
 * @method static Product|Proxy findOrCreate(array $attributes)
 * @method static Product|Proxy first(string $sortedField = 'id')
 * @method static Product|Proxy last(string $sortedField = 'id')
 * @method static Product|Proxy random(array $attributes = [])
 * @method static Product|Proxy randomOrCreate(array $attributes = [])
 * @method static Product[]|Proxy[] all()
 * @method static Product[]|Proxy[] findBy(array $attributes)
 * @method static Product[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Product[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductRepository|RepositoryProxy repository()
 * @method Product|Proxy create($attributes = [])
 */
final class ProductFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realText(20),
            'description' => self::faker()->paragraph(
                self::faker()->numberBetween(3,5), true
            ),
            'price' => rand(5, 50),
            'image' => '/images/box.png',
            'rating' => rand(0, 5),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            ->afterInstantiate(function(Product $product) {
                if (!$product->getSlug()) {
                    $slugger = new AsciiSlugger();
                    $product->setSlug($slugger->slug($product->getName()));
                }
            })
        ;
    }

    protected static function getClass(): string
    {
        return Product::class;
    }
}
