<?php

namespace App\Factory;

use App\Entity\TagLink;
use App\Repository\TagLinkRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<TagLink>
 *
 * @method static TagLink|Proxy createOne(array $attributes = [])
 * @method static TagLink[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static TagLink[]|Proxy[] createSequence(array|callable $sequence)
 * @method static TagLink|Proxy find(object|array|mixed $criteria)
 * @method static TagLink|Proxy findOrCreate(array $attributes)
 * @method static TagLink|Proxy first(string $sortedField = 'id')
 * @method static TagLink|Proxy last(string $sortedField = 'id')
 * @method static TagLink|Proxy random(array $attributes = [])
 * @method static TagLink|Proxy randomOrCreate(array $attributes = [])
 * @method static TagLink[]|Proxy[] all()
 * @method static TagLink[]|Proxy[] findBy(array $attributes)
 * @method static TagLink[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TagLink[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TagLinkRepository|RepositoryProxy repository()
 * @method TagLink|Proxy create(array|callable $attributes = [])
 */
final class TagLinkFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'id_tag' => self::faker()->randomNumber(),
            'id_annonce' => self::faker()->randomNumber(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(TagLink $tagLink): void {})
        ;
    }

    protected static function getClass(): string
    {
        return TagLink::class;
    }
}
