<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase
{
    private $user;

    private $task;

    public function setUp()
    {
        $this->user = new User();
        $this->task = new Task();
    }

    public function testId()
    {
        $this->user->setId(1);
        $this->assertSame(1, $this->user->getId());
    }

    public function testUsername()
    {
        $this->user->setUsername('Bob');
        $this->assertSame('Bob', $this->user->getUsername());
    }

    public function testPassword()
    {
        $this->user->setPassword('azertyui');
        $this->assertSame('azertyui', $this->user->getPassword());
    }

    public function testEmail()
    {
        $this->user->setEmail('root@root.fr');
        $this->assertSame('root@root.fr', $this->user->getEmail());
    }

    public function testRoles()
    {
        $this->user->setRoles(['ROLE_USER']);
        $this->assertSame(['ROLE_USER'], $this->user->getRoles());
    }

    public function testTasks()
    {
        $tasks = $this->user->getTasks($this->task->getUser());
        $this->assertSame($this->user->getTasks(), $tasks);

        $this->user->addtask($this->task);
        $this->assertCount(1, $this->user->getTasks());

        $this->user->removeTask($this->task);
        $this->assertCount(0, $this->user->getTasks());
    }


    public function testSalt()
    {
        $this->assertEquals(null, $this->user->getSalt());
    }

    public function testEraseCredential()
    {
       $this->assertNull($this->user->eraseCredentials());
    }

}