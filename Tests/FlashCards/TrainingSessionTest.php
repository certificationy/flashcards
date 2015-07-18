<?php
/*
 * This file is part of the Certificationy application.
 *
 * (c) Vincent Composieux <vincent.composieux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Certification\Tests;

use Certificationy\FlashCards\FlashCard;
use Certificationy\FlashCards\TrainingSession;
/**
 * TrainingSessionTest
 *
 * @author Mickaël Andrieu <andrieu.travail@gmail.com>
 */
class TrainingSessionTest extends \PHPUnit_Framework_TestCase
{
    private $flashCards = [];

    protected function setUp()
    {
        $this->flashCards[] = new FlashCard('What is a cat ?', 'an animal');
        $this->flashCards[] = new FlashCard('What is a cow ?', 'an animal', 5);
        $this->flashCards[] = new FlashCard('What is Symfony ?', 'a collection of stable libraries and also a PHP framework', 9);
        $this->flashCards[] = new FlashCard('Wtf ?', 'such a bad code', 2);
    }

    public function testPlayASession()
    {
        $trainingSession = new TrainingSession($this->flashCards);

        $flashCard = $trainingSession->pop();

        $this->assertTrue($flashCard instanceof FlashCard);
        $this->assertSame($flashCard, $trainingSession->getSelectedFlashCard());

        $trainingSession->update(3);

        $this->assertEquals(3, $trainingSession->getSelectedFlashCard()->getLevel());
    }

    public function testPop()
    {
        $trainingSession = new TrainingSession($this->flashCards);

        $iterations = 10000;
        $cats = 0;
        $cows = 0;
        $symfonys = 0;
        $wtfs = 0;

        for($i =0; $i < $iterations; $i++) {
            $flashCard = $trainingSession->pop();

            switch($flashCard->getQuestion()) {
                case 'What is a cat ?': $cats++; break;
                case 'What is a cow ?': $cows++; break;
                case 'What is Symfony ?': $symfonys++; break;
                case 'Wtf ?': $wtfs++; break;
            }
        }

            $this->assertTrue($symfonys > $cows);
            $this->assertTrue($cows > $wtfs);
            $this->assertTrue($wtfs > $cats);
    }
}
