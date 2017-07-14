<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * CodeFlix\Models\Serie
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $thumb
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Serie extends Model implements TableInterface
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Título', 'Descrição'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Título':
                return $this->title;
            case 'Descrição':
                return $this->description;
        }
    }
}
