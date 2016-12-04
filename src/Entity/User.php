<?php   // src/Entity/User.php

namespace MiW16\Results\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(
 *     name="users",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="UNIQ_TOKEN", columns={"token"}
 *          )
 *      }
 *     )
 * @ORM\Entity
 */
class User implements \JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=40, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=60, nullable=false)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=40, nullable=false)
     */
    private $token;

    /**
     * Constructor
     */
    public function __construct($username, $email, $password)
    {
        $this->id = 0;
        $this->username = $username;
        $this->email = $email;
        $this->password =  password_hash($password, PASSWORD_DEFAULT);
        $this->enabled = false;
        $this->token = sha1(uniqid($username, true));
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
      return "User " . $this->id . ": username: " . $this->username . " email: " . $this->email . PHP_EOL;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
      return [
          'user' => [
              'username' => $this->username,
              'email' => $this->email,
              'enabled' => $this->enabled
          ]
      ];
    }
}
