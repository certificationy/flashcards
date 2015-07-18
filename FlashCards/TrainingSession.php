<?php

/*
 * This file is part of the Certificationy application.
 *
 * (c) Vincent Composieux <vincent.composieux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Certificationy\FlashCards;

/**
 * Class TrainingSession
 *
 * @author Mickaël Andrieu <andrieu.travail@gmail.com>
 */
class TrainingSession
{
    /**
     * @var FlashCard[] a collection of flash cards
     */
    protected $flashcards;

    /**
     * @var array an collection of weights
     */
    protected $values = [];

    /**
     * @var int the position of the selected flash card
     */
    protected $selectedPosition;

    /**
     * @param $flashcards
     */
    public function __construct($flashcards)
    {
        $this->flashcards   = $flashcards;

        foreach($this->flashcards as $flashcard)
        {
            $this->values[] = $flashcard->getLevel();
        }
    }

    /**
     * Select a random flash card from collection
     *
     * @return FlashCard
     */
    public function pop()
    {
        $flashCards = [];

        foreach($this->flashcards as $position => $flashcard) {
            $i = $flashcard->getLevel();
            while($i >= 0){
                $flashCards[] = $position;
                $i--;
            }
        }
        $position = $flashCards[array_rand($flashCards)];
        $this->selectedPosition = $position;

        return $this->flashcards[$position];
    }

    /**
     * Update the level of knowledge of a flash card from collection
     *
     * @param int $levelOfKnowledge
     * @return TrainingSession
     */
    public function update($levelOfKnowledge)
    {
        $position = $this->selectedPosition;
        $this->flashcards[$position]->setLevel($levelOfKnowledge);

        return $this;
    }

    /**
     * Return the selected flash card
     *
     * @return FlashCard
     */
    public function getSelectedFlashCard()
    {
        $position = $this->selectedPosition;

        return $this->flashcards[$position];
    }
}

