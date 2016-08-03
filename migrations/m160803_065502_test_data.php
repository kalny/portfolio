<?php

use yii\db\Migration;

class m160803_065502_test_data extends Migration
{
    public function safeUp()
    {
        $userId = 22;
        $avatar = 'test-avatar.png';
        $work1 = 'first-work.png';
        $work2 = 'second-work.png';

        $portfolioId = 32;
        $rating = 4;
        
        $this->delete('{{%email}}');
        $this->delete('{{%link}}');
        $this->delete('{{%paragraph}}');
        $this->delete('{{%phone}}');
        $this->delete('{{%voting}}');
        $this->delete('{{%work}}');
        $this->delete('{{%portfolio}}');

        $this->insert('{{%portfolio}}', [
            'id' => $portfolioId, 
            'user_id' => $userId, 
            'name' => 'Web Developer', 
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, at atque beatae, earum, enim eum ipsum itaque minima quam saepe sunt vero voluptates. Consequuntur cumque delectus et necessitatibus nostrum? Consequuntur.',
            'avatar' => $avatar,
            'rating' => $rating,
        ]);

        $this->insert('{{%email}}', [
            'id' => 1,
            'portfolio_id' => $portfolioId,
            'user_id' => $userId,
            'email' => 'example@server.com',
        ]);

        $this->batchInsert('{{%link}}', ['id', 'portfolio_id', 'user_id', 'url', 'anchor', 'title', 'description'], [
            [1, $portfolioId, $userId, 'example.com', 'example', NULL, 'this is description'],
            [2, $portfolioId, $userId, 'example2.com', 'second example site', 'My site', NULL],
        ]);

        $this->batchInsert('{{%phone}}', ['id', 'portfolio_id', 'user_id', 'number', 'note'], [
            [1, $portfolioId, $userId, '055 555 55 55', NULL],
            [2, $portfolioId, $userId, '066 666 66 66', 'No longer available'],
        ]);

        $this->batchInsert('{{%paragraph}}', ['id', 'portfolio_id', 'user_id', 'content'], [
            [1, $portfolioId, $userId, '###Lorem ipsum dolor sit amet
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, at atque beatae, earum, enim eum ipsum itaque minima quam saepe sunt vero voluptates. Consequuntur cumque delectus et necessitatibus nostrum? Consequuntur'],
            [2, $portfolioId, $userId, '###Lorem ipsum
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, at atque beatae, earum, enim eum ipsum itaque minima quam saepe sunt vero voluptates. Consequuntur cumque delectus et necessitatibus nostrum? Consequuntur.'],
            [3, $portfolioId, $userId, '###Lorem ipsum dolor sit
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, at atque beatae, earum, enim eum ipsum itaque minima quam saepe sunt vero voluptates. Consequuntur cumque delectus et necessitatibus nostrum? Consequuntur.'],
            [4, $portfolioId, $userId, '###Lorem ipsum dolor sit amet
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, at atque beatae, earum, enim eum ipsum itaque minima quam saepe sunt vero voluptates. Consequuntur cumque delectus et necessitatibus nostrum? Consequuntur.'],
        ]);

        $this->batchInsert('{{%work}}', ['id', 'portfolio_id', 'user_id', 'title', 'description', 'link', 'image'], [
            [1, $portfolioId, $userId, 'Example work', 'This is my Example Work', 'examplework.com', $work1],
            [2, $portfolioId, $userId, 'My 2 example work', 'This is my second work without link', NULL, $work2],
            [3, $portfolioId, $userId, 'Work', 'This is my work without image', 'thirdwork.com', NULL],
        ]);

        $this->insert('{{%voting}}', [
            'portfolio_id' => $portfolioId,
            'user_id' => $userId,
            'rate' => $rating,
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%email}}');
        $this->delete('{{%link}}');
        $this->delete('{{%paragraph}}');
        $this->delete('{{%phone}}');
        $this->delete('{{%voting}}');
        $this->delete('{{%work}}');
        $this->delete('{{%portfolio}}');
    }
}

?>


