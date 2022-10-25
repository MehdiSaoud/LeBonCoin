<?php

namespace App\Factory;

use App\Entity\Vote;
use App\Repository\VoteRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Vote>
 *
 * @method static Vote|Proxy createOne(array $attributes = [])
 * @method static Vote[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Vote[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Vote|Proxy find(object|array|mixed $criteria)
 * @method static Vote|Proxy findOrCreate(array $attributes)
 * @method static Vote|Proxy first(string $sortedField = 'id')
 * @method static Vote|Proxy last(string $sortedField = 'id')
 * @method static Vote|Proxy random(array $attributes = [])
 * @method static Vote|Proxy randomOrCreate(array $attributes = [])
 * @method static Vote[]|Proxy[] all()
 * @method static Vote[]|Proxy[] findBy(array $attributes)
 * @method static Vote[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Vote[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static VoteRepository|RepositoryProxy repository()
 * @method Vote|Proxy create(array|callable $attributes = [])
 */
final class VoteFactory extends ModelFactory
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
            'vote' => self::faker()->numberBetween(0,1),
            'id_user' => UserFactory::random(),
            'id_seller' => UserFactory::random(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Vote $vote): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Vote::class;
    }
}
