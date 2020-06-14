<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

final class Article extends Model
{
    protected $fillable = ['title', 'text'];

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();
        $id = $data['id'];
        unset($data['id']);

        return [
            'type' => 'articles',
            'id' => $id,
            'attributes' => $data
        ];
    }
}
