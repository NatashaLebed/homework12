<?php

namespace Acme\DemoBundle\Tests\Utility;

use Lebed\GuestbookBundle\Entity\Post;

class PostTest extends \PHPUnit_Framework_TestCase
{
    public function testSetSlug()
    {
        $post = new Post();
        $post->setSlug('Hello Geekhubers');
        $result = $post->getSlug();

        $this->assertEquals('hello-geekhubers', $result);
    }
}