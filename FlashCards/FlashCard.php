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
 * Class FlashCard
 *
 * @author Mickaël Andrieu <andrieu.travail@gmail.com>
 */
class FlashCard
{
    const POOR_KNOWLEDGE = -1;
    const NORMAL_KNOWLEDGE = 0;
    const GOOD_KNOWLEDGE = 1;
    const MIN_KNOWLEDGE = 1;
    const MAX_KNOWLEDGE = 10;

    /**
     * @var string
     */
    protected $question;

    /**
     * @var string
     */
    protected $answer;

    /**
     * @var int
     */
    protected $level;

    /**
     * @param $question
     * @param $answer
     * @param int $level
     */
    public function __construct($question, $answer, $level = self::NORMAL_KNOWLEDGE)
    {
        $this->question   = $question;
        $this->answer     = $answer;

        if ($level >= self::MIN_KNOWLEDGE && $level <= self::MAX_KNOWLEDGE) {
            $this->level = $level;
        }else {
            $this->level = self::NORMAL_KNOWLEDGE;
        }

    }

    /**
     * @param string $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param int $knowledge
     */
    public function updateKnowledge($knowledge)
    {
        $newLevel = $this->level + $knowledge;
        if ($newLevel >= self::MIN_KNOWLEDGE && $newLevel <= self::MAX_KNOWLEDGE){
            $this->level = $newLevel;
        }
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        if ($level >= self::MIN_KNOWLEDGE && $level <= self::MAX_KNOWLEDGE) {
            $this->level = $level;
        }
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
