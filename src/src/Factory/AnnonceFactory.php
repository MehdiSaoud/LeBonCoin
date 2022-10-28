<?php

namespace App\Factory;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Annonce>
 *
 * @method static Annonce|Proxy createOne(array $attributes = [])
 * @method static Annonce[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Annonce[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Annonce|Proxy find(object|array|mixed $criteria)
 * @method static Annonce|Proxy findOrCreate(array $attributes)
 * @method static Annonce|Proxy first(string $sortedField = 'id')
 * @method static Annonce|Proxy last(string $sortedField = 'id')
 * @method static Annonce|Proxy random(array $attributes = [])
 * @method static Annonce|Proxy randomOrCreate(array $attributes = [])
 * @method static Annonce[]|Proxy[] all()
 * @method static Annonce[]|Proxy[] findBy(array $attributes)
 * @method static Annonce[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Annonce[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AnnonceRepository|RepositoryProxy repository()
 * @method Annonce|Proxy create(array|callable $attributes = [])
 */
final class AnnonceFactory extends ModelFactory
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
            'title' => self::faker()->word(),
            'description' => self::faker()->text(),
            'price' => self::faker()->randomFloat(),
            'dateCreation' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'id_user' => UserFactory::random(),
            'photos' => 'default.png',
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Annonce $annonce): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Annonce::class;
    }
}
