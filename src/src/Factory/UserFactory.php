<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ModelFactory<User>
 *
 * @method static User|Proxy createOne(array $attributes = [])
 * @method static User[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static User[]|Proxy[] createSequence(array|callable $sequence)
 * @method static User|Proxy find(object|array|mixed $criteria)
 * @method static User|Proxy findOrCreate(array $attributes)
 * @method static User|Proxy first(string $sortedField = 'id')
 * @method static User|Proxy last(string $sortedField = 'id')
 * @method static User|Proxy random(array $attributes = [])
 * @method static User|Proxy randomOrCreate(array $attributes = [])
 * @method static User[]|Proxy[] all()
 * @method static User[]|Proxy[] findBy(array $attributes)
 * @method static User[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static User[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method User|Proxy create(array|callable $attributes = [])
 */
final class UserFactory extends ModelFactory
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        parent::__construct();

        $this->hasher = $hasher;
        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        $randin = random_int(1,2);
        if ($randin == 1 ){
            $roles[] = 'ROLE_ADMIN';
        }else{
            $roles[] = 'ROLE_USER';
        }
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'lastname' => self::faker()->name(),
            'firstname' => self::faker()->firstName(),
            'pseudo' => self::faker()->name(),
            'email' => self::faker()->email(),
            'localisation'=> self::faker()->word(),
            'profilePicture' => 'default.jpeg',
            'accountCreationDate' => self::faker()->dateTime(),
            'roles' => $roles
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this->afterInstantiate(function(User $user): void {
            $user->setPassword($this->hasher->hashPassword($user, 'password'));
        });
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}
