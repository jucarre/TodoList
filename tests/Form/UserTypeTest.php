<?php


namespace App\Tests\Form;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Form;

class UserTypeTest extends TypeTestCase
{
    private $validator;

    protected function getExtensions(): array
    {
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator
            ->method('getMetadataFor')
            ->willReturn(new ClassMetadata(Form::class));
        $this->validator
            ->method('validate')
            ->willReturn(new ConstraintViolationList());

        return array(
            new ValidatorExtension($this->validator)
        );
    }

    public function testSubmitValidData(): void
    {
        $formData = array(
            'username' => 'bob',
            'password' => ['first' => 'root', 'second' => 'root'],
            'email' => 'email@email.fr',
            'roles' => ['ROLE_USER']
        );

        $objectToCompare = new User();
        $form = $this->factory->create(UserType::class, $objectToCompare);

        $user = new User();
        $user->setUsername($formData['username']);
        $user->setPassword($formData['password']['first']);
        $user->setEmail($formData['email']);
        $user->setRoles($formData['roles']);

        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($user, $objectToCompare);
        $this->assertSame($user->getUsername(), $form->get('username')->getData());
        $this->assertSame($user->getPassword(), $form->get('password')->getData());
        $this->assertSame($user->getEmail(), $form->get('email')->getData());
        $this->assertSame($user->getRoles(), $form->get('roles')->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}