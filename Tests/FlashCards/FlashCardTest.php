<?php
/*
 * This file is part of the Certificationy application.
 *
 * (c) Vincent Composieux <vincent.composieux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Certificationy\Tests;

use Certificationy\FlashCards\FlashCard;

/**
 * FlashCardTest
 *
 * @author Mickaël Andrieu <andrieu.travail@gmail.com>
 */
class FlashCardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests getters and setters
     */
    public function testGettersSetters()
    {
        $flashCard = new FlashCard('What is the universe answer ?', '42');

        $this->assertEquals('What is the universe answer ?', $flashCard->getQuestion());
        $this->assertEquals('42', $flashCard->getAnswer());
        $this->assertEquals(FlashCard::NORMAL_KNOWLEDGE, $flashCard->getLevel());

        $easyFlashCard = new FlashCard('Vincent is great, true or false ?', 'true', 10);
        $this->assertEquals(10, $easyFlashCard->getLevel());
    }

    public function testKnowledgeCantBeSoPoor()
    {
        $flashCard = new FlashCard('2 + 2 ?', '5', -15);
        $this->assertEquals(FlashCard::NORMAL_KNOWLEDGE, $flashCard->getLevel());
    }

    public function testKnowledgeCantBeSoRich()
    {
        $flashCard = new FlashCard('Did you know ?', 'yes, of course !');
        $flashCard->setLevel(100);
        $this->assertEquals(FlashCard::NORMAL_KNOWLEDGE, $flashCard->getLevel());
    }
}
