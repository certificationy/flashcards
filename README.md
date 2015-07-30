# Flashcards

Flashcards is a very naive PHP implementation of The Leitner Flash Card System learning strategy.

Repeated study of vocabulary, concepts, events, or other items is still the most efficient way to learn them.
For awhile, rote memorization was dismissed as "drill and kill," until it was realized the drill and kill really works.
For that reason, flash cards remain a popular study aid. And flash cards are flexible supports.

If you want to go further, take a look the wikipedia page of this method: https://en.wikipedia.org/wiki/Leitner_system


## Installation

**flashcards** is a PHP package registered to packagist, you can clone the repository or require it with composer:

```bash
$ composer require "certificationy/flashcards"
```

## Usage

The best you can do is take a look to the tests.
The library provide you 2 mains objects for now: ``FlashCard`` and ``TrainingSession``.

A flashcard have a question, an answer and can be associated to a level of knowledge.

For instance, this is a flashcard:

```php
$card = new \Certificationy\FlashCard('What is the best PHP framework ?', 'Symfony');

$card->getQuestion(); // What is the best PHP framework ?
$card->getAnswer(); // Symfony
$card->getLevel(); // 0
```

Now the key is not to guess the answer **but** to evaluate your level of knowledge associated to the answer:

* is this question easy for you ?
* or hard ?

Then the FlashCard can be updated, of course in a database system
this value should be probably stored in a specific table with user identifier, and flashcard identifier.

```php
$card->updateLevel(\Certificationy\FlashCard::GOOD_KNOWLEDGE);
```

What is happening here ? This library accept 10 levels of knowledge for a question:
* 10 you don't know at all the answer, you need to repeat this FlashCard;
* 1 you know perfectly the answer, you don't need to see again this FlashCard;

Obviously, during a training session your knowledge of answers will change and by the way the level associated to the FlashCards
have to be updated.

Let's introduce the ``Certification\TrainingSession`` object:

```php
$flashCards = [
    new FlashCard('What is a cat ?', 'an animal'),
    new FlashCard('What is a cow ?', 'an animal', 5),
    new FlashCard('What is Symfony ?', 'a collection of stable libraries and also a PHP framework', 9),
    new FlashCard('Wtf ?', 'such a bad code', 2)
    ];
$trainingSession = new \Certificationy\TrainingSession($flashCards);

// let's get a flashcard
$card = $trainingSession->pop();

// now, user have to evaluate the card
$trainingSession->update(FlashCard::GOOD_KNOWLEDGE); // the level of selected flashcard was decreased of 1
```
You can see a training like a randomised list of weighted items, the more you need to learn a card, the more it appears.

## ROADMAP for 1.0

* Add adaptor to use the packs from certificationy
* Provide a minimalist database implementation system
* Create a "ready to use" web application to learn
* Create a console application or update ``certificationy-cli`` (to be discussed)
